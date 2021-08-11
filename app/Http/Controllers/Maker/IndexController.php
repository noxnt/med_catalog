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

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 20;

        $filter = app()->make(MakerFilter::class, ['queryParams' => array_filter($data)]);

        $makers = Maker::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        $makers = $this->service->index($makers);

        return view('maker.index', compact('makers'));
    }
}
