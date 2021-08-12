<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\Product\ProductResource;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $product = $this->service->store($data);

        if (request()->wantsJson())
            return new ProductResource($product);

        return redirect()->route('products.index');
    }
}
