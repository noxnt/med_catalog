<?php

namespace App\Http\Controllers\Maker;

use App\Http\Requests\Maker\UpdateRequest;
use App\Models\Maker;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Maker $maker)
    {
        $data = $request->validated();

        $this->service->update($maker, $data);

        return redirect()->route('maker.index');
    }
}
