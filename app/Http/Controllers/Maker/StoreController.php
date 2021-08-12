<?php

namespace App\Http\Controllers\Maker;

use App\Http\Requests\Maker\StoreRequest;
use App\Http\Resources\Maker\MakerResource;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $maker = $this->service->store($data);

        if (request()->wantsJson())
            return new MakerResource($maker);

        return redirect()->route('makers.index');
    }
}
