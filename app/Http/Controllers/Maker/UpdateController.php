<?php

namespace App\Http\Controllers\Maker;

use App\Http\Requests\Maker\UpdateRequest;
use App\Http\Resources\Maker\MakerResource;
use App\Models\Maker;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Maker $maker)
    {
        $data = $request->validated();

        $maker = $this->service->update($maker, $data);

        if (request()->wantsJson())
            return new MakerResource($maker);

        return redirect()->route('makers.index');
    }
}
