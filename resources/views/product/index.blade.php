@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <h2 class="w-50">List of medicines ({{ $products->total() }}):</h2>
        <form class="input-group w-50" action="{{ route('products.index') }}" method="GET">
            <input type="search" class="form-control rounded" placeholder="Search by name" name="name">
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3 pl-0">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse"
                        aria-expanded="false" aria-controls="multiCollapseExample2">Add new product
                </button>
                <a class="btn btn-secondary" href="{{ route('makers.index') }}">Makers</a>
                <a class="btn btn-secondary" href="{{ route('substances.index') }}">Active substances</a>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="collapse multi-collapse" id="formCollapse">
                        <div class="card card-body">
                            <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" placeholder="Enter name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="substances">Active substance</label>
                                    <select class="form-control" id="substances" name="substance_id">
                                        @foreach($substances as $substance)
                                            <option value="{{ $substance->id }}">{{ $substance->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="makers">Maker</label>
                                    <select class="form-control" id="makers" name="maker_id">
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input class="form-control" name="price" type="number" min="0" id="price" placeholder="Price">
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
                <th scope="col">Active substance</th>
                <th scope="col">Maker</th>
                <th scope="col">Price</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th class="align-middle" scope="row">{{ $product->id }}</th>
                    <td class="align-middle"><a href="{{ route('products.edit', $product->id) }}">{{ $product->name }}</a></td>
                    <td class="align-middle">{{ $product->substance }}</td>
                    <td class="align-middle">{{ $product->maker }}</td>
                    <td class="align-middle">{{ $product->price }}</td>
                    <td class="align-middle">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-1">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
@endsection
