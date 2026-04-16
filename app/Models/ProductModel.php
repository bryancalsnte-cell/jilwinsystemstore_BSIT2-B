<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // ⚠️ make sure table name tama
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'price', 'quantity'];

    public function getRecords($start, $length, $searchValue = '')
    {
        $builder = $this->builder();
        $builder->select('*');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->orLike('name', $searchValue)
                ->orLike('price', $searchValue)
                ->orLike('quantity', $searchValue)
                ->groupEnd();
        }

        // Clone builder for filtered count
        $filteredBuilder = clone $builder;
        $filteredRecords = $filteredBuilder->countAllResults();

        $builder->limit($length, $start);
        $data = $builder->get()->getResultArray();

        return [
            'data' => $data,
            'filtered' => $filteredRecords
        ];
    }
}