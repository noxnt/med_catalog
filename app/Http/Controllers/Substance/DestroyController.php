<?php

namespace App\Http\Controllers\Substance;

use App\Http\Resources\Substance\SubstanceResource;
use App\Models\Substance;

class DestroyController extends BaseController
{
    public function __invoke(Substance $substance)
    {
        $substance = $this->service->destroy($substance);

        if (request()->wantsJson()) {
            return $substance instanceof Substance ? new SubstanceResource($substance) : $substance;
        }

        return redirect()->route('substances.index');
    }
}
