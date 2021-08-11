<?php

namespace App\Http\Controllers\Substance;

use App\Models\Substance;

class DestroyController extends BaseController
{
    public function __invoke(Substance $substance)
    {
        $this->service->destroy($substance);

        return redirect()->route('substances.index');
    }
}
