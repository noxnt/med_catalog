<?php

namespace App\Http\Controllers\Substance;

use App\Http\Requests\Substance\UpdateRequest;
use App\Http\Resources\Substance\SubstanceResource;
use App\Models\Substance;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Substance $substance)
    {
        $data = $request->validated();

        $substance = $this->service->update($substance, $data);

        if (request()->wantsJson())
            return new SubstanceResource($substance);

        return redirect()->route('substances.index');
    }
}
