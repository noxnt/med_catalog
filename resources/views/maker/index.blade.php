@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <h2 class="w-50">List of makers ({{ $makers->total() }}):</h2>
        <form class="input-group w-50" action="{{ route('makers.index') }}" method="GET">
            <input type="search" class="form-control rounded" placeholder="Search by name" name="name">
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3 pl-0">
            <p>
                <a class="btn btn-secondary" href="{{ route('products.index') }}">Products</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse"
                        aria-expanded="false" aria-controls="multiCollapseExample2">Add new maker
                </button>
                <a class="btn btn-secondary" href="{{ route('substances.index') }}">Active substances</a>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="collapse multi-collapse" id="formCollapse">
                        <div class="card card-body">
                            <form action="{{ route('makers.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           id="name" placeholder="Enter name" name="name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Link</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           type="url" id="name" placeholder="Enter link" name="link">
                                    @error('link')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Link</th>
                <th scope="col">Products</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($makers as $maker)
                <tr>
                    <th class="align-middle" scope="row">{{ $maker->id }}</th>
                    <td class="align-middle"><a href="{{ route('makers.edit', $maker->id) }}">{{ $maker->name }}</a></td>
                    <td class="align-middle"><a href="{{ $maker->link }}">Click</a></td>
                    <td class="align-middle">
                        <a class="btn btn-primary" href="{{ route('products.index', ['maker_id' => $maker->id]) }}">
                            {{ $maker->product_count }}
                        </a>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('makers.destroy', $maker->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if($makers->total() > 10)
        <div class="row w-100 mt-1">
            <div class="col-md-9">
                {{ $makers->withQueryString()->links() }}
            </div>
            <div class="col-md-1 p-0 pt-2">
                <p class="text-right">Show:</p>
            </div>
            <form class="col-md-2 page-form">
                <select class="form-control page-select" name="per_page">
                    @foreach([10,20,50] as $item)
                        <option value="{{ $item }}" {{ session('per_page') == $item ? ' selected' : '' }}>{{ $item }} rows</option>
                    @endforeach
                </select>
            </form>
        </div>
        @endif
    </div>
@endsection
