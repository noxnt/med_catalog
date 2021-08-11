<?php

namespace App\Http\Controllers\Substance;

use App\Http\Filters\SubstanceFilter;
use App\Http\Requests\Substance\FilterRequest;
use App\Models\Substance;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(SubstanceFilter::class, ['queryParams' => array_filter($data)]);

        $substances = Substance::filter($filter)->paginate(20);

        $substances = $this->service->index($substances);

        return view('substance.index', compact('substances'));
    }
}
