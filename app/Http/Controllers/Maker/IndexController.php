<?php

namespace App\Http\Controllers\Maker;

use App\Http\Filters\MakerFilter;
use App\Http\Requests\Maker\FilterRequest;
use App\Models\Maker;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(MakerFilter::class, ['queryParams' => array_filter($data)]);

        $makers = Maker::filter($filter)->paginate(20);

        $makers = $this->service->index($makers);

        return view('maker.index', compact('makers'));
    }
}
