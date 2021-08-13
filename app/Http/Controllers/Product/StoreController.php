<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $product = $this->service->store($data);

        if (request()->wantsJson()) {
            return $product instanceof Product ? new ProductResource($product) : $product;
        }

        return redirect()->route('products.index');
    }
}
