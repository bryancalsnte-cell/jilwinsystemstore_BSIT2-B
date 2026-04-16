<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SalesModel;

class Report extends BaseController
{
    public function index()
    {
        return view('reports/index');
    }

    // ✅ DAILY SALES
    public function dailySales()
    {
        $db = \Config\Database::connect();
        $date = $this->request->getGet('date') ?? date('Y-m-d');

        $data = $db->table('sales s')
            ->select('p.name, SUM(s.quantity) as total_qty, SUM(s.total_price) as total_sales')
            ->join('products p', 'p.id = s.product_id')
            ->where('DATE(s.created_at)', $date)
            ->groupBy('s.product_id')
            ->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    // ✅ INVENTORY REPORT
    public function inventory()
    {
        $model = new ProductModel();
        return $this->response->setJSON($model->findAll());
    }
}