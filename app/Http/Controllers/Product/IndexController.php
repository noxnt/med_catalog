<?php

namespace App\Http\Controllers\Product;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Substance;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->paginate(20);

        $products = $this->service->index($products);

        $makers = Maker::all();
        $substances = Substance::all();

        return view('product.index', compact(['products', 'makers', 'substances']));
    }
}
