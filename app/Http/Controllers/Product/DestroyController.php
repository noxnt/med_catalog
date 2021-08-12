<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class DestroyController extends BaseController
{
    public function __invoke(Product $product)
    {
        $product = $this->service->destroy($product);

        if (request()->wantsJson())
            return new ProductResource($product);

        return redirect()->route('products.index');
    }
}
