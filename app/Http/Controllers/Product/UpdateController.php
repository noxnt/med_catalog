<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $product = $this->service->update($product, $data);

        if (request()->wantsJson()) {
            return $product instanceof Product ? new ProductResource($product) : $product;
        }

        return redirect()->route('products.index');
    }
}
