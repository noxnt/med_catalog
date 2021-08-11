<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Substance;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $makers = Maker::all();
        $substances = Substance::all();

        return view('product.edit', compact(['product', 'substances', 'makers']));
    }
}
