<?php


namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Service
{
    public function index($products)
    {
        foreach ($products as $product) {
            $product['substance'] = $product->substance()->value('name');
            $product['maker'] = $product->maker()->value('name');
        }

        return $products;
    }

    public function store($data)
    {
        try {
            Db::beginTransaction();
            Product::create($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
    }

    public function update($product, $data)
    {
        try {
            Db::beginTransaction();
            $product->update($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
        return $product->fresh();
    }
}
