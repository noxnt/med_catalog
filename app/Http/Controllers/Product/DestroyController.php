<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;

class DestroyController extends BaseController
{
    public function __invoke(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
