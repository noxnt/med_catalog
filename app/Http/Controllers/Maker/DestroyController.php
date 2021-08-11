<?php

namespace App\Http\Controllers\Maker;

use App\Models\Maker;

class DestroyController extends BaseController
{
    public function __invoke(Maker $maker)
    {
        $this->service->destroy($maker);

        return redirect()->route('makers.index');
    }
}
