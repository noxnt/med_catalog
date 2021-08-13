@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <h2 class="w-50">List of active substances ({{ $substances->total() }}):</h2>
        <form class="input-group w-50" action="{{ route('substances.index') }}" method="GET">
            <input type="search" class="form-control rounded" placeholder="Search by name" name="name">
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3 pl-0">
            <p>
                <a class="btn btn-secondary" href="{{ route('products.index') }}">Products</a>
                <a class="btn btn-secondary" href="{{ route('makers.index') }}">Makers</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse"
                        aria-expanded="false" aria-controls="multiCollapseExample2">Add new active substance
                </button>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="collapse multi-collapse" id="formCollapse">
                        <div class="card card-body">
                            <form action="{{ route('substances.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" name="name">
                                    @error('name')
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
                <th scope="col">Products</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($substances as $substance)
                <tr>
                    <th class="align-middle" scope="row">{{ $substance->id }}</th>
                    <td class="align-middle"><a href="{{ route('substances.edit', $substance->id) }}">{{ $substance->name }}</a></td>
                    <td class="align-middle">
                        <a class="btn btn-primary" href="{{ route('products.index', ['substance_id' => $substance->id]) }}">
                            {{ $substance->product_count }}
                        </a>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('substances.destroy', $substance->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if($substances->total() > 10)
        <div class="row w-100 mt-1">
            <div class="col-md-9">
                {{ $substances->withQueryString()->links() }}
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
