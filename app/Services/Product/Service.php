<?php


namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $product = Product::create($data);
            $this->loggingSuccess($product, 'creating');
            Db::commit();

        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'create');
            return $exception->getMessage();
        }
        return $product;
    }

    public function update($product, $data)
    {
        try {
            Db::beginTransaction();
            $product->update($data);
            $this->loggingSuccess($product, 'updating');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'update');
            return $exception->getMessage();
        }
        return $product->fresh();
    }

    public function destroy($product)
    {
        try {
            Db::beginTransaction();
            $deleted = $product;
            $product->delete();
            $this->loggingSuccess($product, 'deletion');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'delete');
            return $exception->getMessage();
        }
        return $deleted;
    }

    // Logs
    private function loggingSuccess($product, $action) {
        Log::channel('debuginfo')->info("Successful $action - product", [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
        ]);
    }

    private function loggingFailed($exception, $action) {
        Log::channel('debuginfo')->error("Failed to $action - product", [
            'error' => $exception->getMessage(),
        ]);
    }
}
