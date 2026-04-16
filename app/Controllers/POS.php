<?php

namespace App\Controllers;

use App\Models\ProductModel;

class POS extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        return view('pos/index', $data);
    }

    public function checkout()
    {
        $db = \Config\Database::connect();
        $model = new ProductModel();

        $cart = $this->request->getPost('cart');

        foreach ($cart as $item) {

            $product = $model->find($item['id']);

            // ❌ prevent negative stock
            if ($product['quantity'] < $item['qty']) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Not enough stock for ' . $product['name']
                ]);
            }

            // ✅ bawas stock
            $newQty = $product['quantity'] - $item['qty'];
            $model->update($item['id'], ['quantity' => $newQty]);

            // ✅ save sales
            $db->table('sales')->insert([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'total_price' => $item['price'] * $item['qty']
            ]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }
}