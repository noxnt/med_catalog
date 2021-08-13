<?php

namespace App\Http\Controllers\Substance;

use App\Http\Requests\Substance\StoreRequest;
use App\Http\Resources\Substance\SubstanceResource;
use App\Models\Substance;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $substance = $this->service->store($data);

        if (request()->wantsJson()) {
            return $substance instanceof Substance ? new SubstanceResource($substance) : $substance;
        }

        return redirect()->route('substances.index');
    }
}
