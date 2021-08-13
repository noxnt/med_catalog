@extends('layouts.main')
@section('content')
    <div class="row mt-5">
        <h2>Edit maker "{{ $maker->name }}":</h2>
    </div>

    <div class="row">
        <div class="col-md-6 mt-3 pl-0">
            <div class="card card-body">
                <form action="{{ route('makers.update', $maker->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name"
                               placeholder="Enter name" name="name" value="{{ $maker->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Link</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="url"
                               id="name" placeholder="Enter link" name="link"
                            value="{{ $maker->link }}">
                        @error('link')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Submit</button>
                </form>
                <form action="{{ route('makers.destroy', $maker->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger w-25" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
