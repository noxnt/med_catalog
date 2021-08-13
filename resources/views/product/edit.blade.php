@extends('layouts.main')
@section('content')
    <div class="row mt-5">
        <h2>Edit product "{{ $product->name }}":</h2>
    </div>

    <div class="row">
        <div class="col-md-6 mt-3 pl-0">
            <div class="card card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('patch')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name"
                            name="name" value="{{ $product->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="substances">Active substance</label>
                        <select class="form-control @error('substance_id') is-invalid @enderror" id="substances" name="substance_id">
                            @foreach($substances as $substance)
                                <option value="{{ $substance->id }}"
                                {{ $product->substance_id == $substance->id ? ' selected' : '' }}
                                >{{ $substance->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="makers">Maker</label>
                        <select class="form-control @error('maker_id') is-invalid @enderror" id="makers" name="maker_id">
                            @foreach($makers as $maker)
                                <option value="{{ $maker->id }}"
                                {{ $product->maker_id == $maker->id ? ' selected' : '' }}
                                >{{ $maker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="form-control @error('price') is-invalid @enderror" name="price"
                               type="number" min="0" id="price" placeholder="Price" value="{{ $product->price }}">
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-25">Submit</button>
                </form>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger w-25" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
