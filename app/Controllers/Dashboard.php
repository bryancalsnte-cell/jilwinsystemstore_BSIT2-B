<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // 🔐 Login check (optional)
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $model = new ProductModel();

        // ✅ Total Products
        $data['totalProducts'] = $model->countAll();

        // ✅ Total Stock (safe version)
        $totalStock = $model->selectSum('quantity')->first();
        $data['totalStock'] = $totalStock['quantity'] ?? 0;

        // ✅ Low Stock (below 10)
        $data['lowStock'] = $model
            ->where('quantity <', 10)
            ->findAll();

        return view('dashboard/index', $data);
    }
}