<?php

namespace App\Http\Controllers\Substance;

use App\Http\Filters\SubstanceFilter;
use App\Http\Requests\Substance\FilterRequest;
use App\Http\Resources\Substance\SubstanceResource;
use App\Models\Substance;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $substances = $this->getFilter($data);

        $substances = $this->service->index($substances);

        if (request()->wantsJson()) {
            return $substances instanceof Substance ? SubstanceResource::collection($substances) : $substances;
        }

        return view('substance.index', compact('substances'));
    }

    private function getFilter($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 20;
        session()->put('per_page', $perPage);
        $perPage = $data['per_page'] ?? session('per_page');

        $filter = app()->make(SubstanceFilter::class, ['queryParams' => array_filter($data)]);
        return Substance::filter($filter)->paginate($perPage, ['*'], 'page', $page);
    }
}
