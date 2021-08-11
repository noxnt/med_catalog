<?php

namespace App\Http\Controllers\Maker;

use App\Http\Requests\Maker\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('makers.index');
    }
}
