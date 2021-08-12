<?php

namespace App\Http\Controllers\Maker;

use App\Http\Filters\MakerFilter;
use App\Http\Requests\Maker\FilterRequest;
use App\Http\Resources\Maker\MakerResource;
use App\Models\Maker;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $makers = $this->getFilter($data);

        $makers = $this->service->index($makers);

        if (request()->wantsJson())
            return MakerResource::collection($makers);

        return view('maker.index', compact('makers'));
    }

    private function getFilter($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 20;

        $filter = app()->make(MakerFilter::class, ['queryParams' => array_filter($data)]);
        return Maker::filter($filter)->paginate($perPage, ['*'], 'page', $page);
    }
}
