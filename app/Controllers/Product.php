<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\LogModel;

class Product extends Controller
{
    public function index(){
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('products/index', $data);
    }

    public function save(){
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');

        $productModel = new ProductModel();
        $logModel = new LogModel();

        $data = [
            'name'     => $name,
            'price'    => $price,
            'quantity' => $quantity
        ];

        if ($productModel->insert($data)) {
            $logModel->addLog('New Product added: ' . $name, 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to save product'
            ]);
        }
    }

    public function update(){
        $model = new ProductModel();
        $logModel = new LogModel();

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');

        $data = [
            'name'     => $name,
            'price'    => $price,
            'quantity' => $quantity
        ];

        $updated = $model->update($id, $data);

        if ($updated) {
            $logModel->addLog('Product updated: ' . $name, 'UPDATED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating product.'
            ]);
        }
    }

    public function edit($id){
        $model = new ProductModel();
        $product = $model->find($id);

        if ($product) {
            return $this->response->setJSON(['data' => $product]);
        } else {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => 'Product not found']);
        }
    }

    public function delete($id){
        $model = new ProductModel();
        $logModel = new LogModel();

        $product = $model->find($id);

        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found.'
            ]);
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            $logModel->addLog('Delete product', 'DELETED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete product.'
            ]);
        }
    }

public function stockIn()
{
    $model = new \App\Models\ProductModel();
    $db = \Config\Database::connect();

    $productId = $this->request->getPost('product_id');
    $qty = $this->request->getPost('quantity');

    // update product quantity
    $product = $model->find($productId);
    $newQty = $product['quantity'] + $qty;

    $model->update($productId, ['quantity' => $newQty]);

    // log movement
    $db->table('stock_movements')->insert([
        'product_id' => $productId,
        'type' => 'IN',
        'quantity' => $qty
    ]);

    return $this->response->setJSON(['status' => 'success']);
}

public function stockOut()
{
    $model = new \App\Models\ProductModel();
    $db = \Config\Database::connect();

    $productId = $this->request->getPost('product_id');
    $qty = $this->request->getPost('quantity');

    $product = $model->find($productId);

    if ($product['quantity'] < $qty) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Not enough stock!'
        ]);
    }

    $newQty = $product['quantity'] - $qty;

    $model->update($productId, ['quantity' => $newQty]);

    $db->table('stock_movements')->insert([
        'product_id' => $productId,
        'type' => 'OUT',
        'quantity' => $qty
    ]);

    return $this->response->setJSON(['status' => 'success']);
}



   public function fetchRecords()
{
    $request = service('request');
    $model = new \App\Models\ProductModel();

    $start = $request->getPost('start') ?? 0;
    $length = $request->getPost('length') ?? 10;
    $searchValue = $request->getPost('search')['value'] ?? '';

    $builder = $model->builder();

    if (!empty($searchValue)) {
        $builder->like('name', $searchValue)
                ->orLike('price', $searchValue)
                ->orLike('quantity', $searchValue);
    }

    $totalRecords = $model->countAll();
    $filteredRecords = $builder->countAllResults(false);

    $builder->limit($length, $start);
    $data = $builder->get()->getResultArray();

    $counter = $start + 1;
    foreach ($data as &$row) {
        $row['row_number'] = $counter++;
    }

    return $this->response->setJSON([
        'draw' => intval($request->getPost('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $filteredRecords,
        'data' => $data,
    ]);
}
}