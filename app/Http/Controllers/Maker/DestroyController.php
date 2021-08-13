<?php

namespace App\Http\Controllers\Maker;

use App\Http\Resources\Maker\MakerResource;
use App\Models\Maker;

class DestroyController extends BaseController
{
    public function __invoke(Maker $maker)
    {
        $maker = $this->service->destroy($maker);

        if (request()->wantsJson()) {
            return $maker instanceof Maker ? new MakerResource($maker) : $maker;
        }

        return redirect()->route('makers.index');
    }
}
