<?php

namespace App\Http\Controllers\Substance;

use App\Http\Requests\Substance\StoreRequest;
use App\Http\Resources\Substance\SubstanceResource;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $substance = $this->service->store($data);

        if (request()->wantsJson())
            return new SubstanceResource($substance);

        return redirect()->route('substances.index');
    }
}
