<?php

namespace App\Http\Controllers\Substance;

use App\Http\Requests\Substance\UpdateRequest;
use App\Models\Substance;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Substance $substance)
    {
        $data = $request->validated();

        $this->service->update($substance, $data);

        return redirect()->route('substances.index');
    }
}
