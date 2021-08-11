@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <h2>List of active substances ({{ $substances->total() }}):</h2>
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
                                    <input class="form-control" id="name" placeholder="Enter name" name="name">
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

        <div class="mt-1">
            {{ $substances->withQueryString()->links() }}
        </div>
    </div>
@endsection
