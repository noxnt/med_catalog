<?php

namespace App\Http\Controllers\Substance;

use App\Http\Requests\Substance\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('substances.index');
    }
}
