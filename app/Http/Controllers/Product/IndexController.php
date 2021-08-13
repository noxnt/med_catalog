<?php

namespace App\Http\Controllers\Product;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Substance;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $products = $this->getFilter($data);
        $products = $this->service->index($products);

        if (request()->wantsJson()) {
            return ProductResource::collection($products);
        }

        $makers = Maker::all();
        $substances = Substance::all();

        return view('product.index', compact(['products', 'makers', 'substances']));
    }

    private function getFilter($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 20;
        session()->put('per_page', $perPage);
        $perPage = $data['per_page'] ?? session('per_page');

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        return Product::filter($filter)->paginate($perPage, ['*'], 'page', $page);
    }
}
