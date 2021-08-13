<?php

namespace App\Http\Controllers\Maker;

use App\Http\Requests\Maker\StoreRequest;
use App\Http\Resources\Maker\MakerResource;
use App\Models\Maker;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $maker = $this->service->store($data);

        if (request()->wantsJson()) {
            return $maker instanceof Maker ? new MakerResource($maker) : $maker;
        }

        return redirect()->route('makers.index');
    }
}
