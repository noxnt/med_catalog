@extends('layouts.main')
@section('content')
    <div class="row mt-5">
        <h2>Edit substance "{{ $substance->name }}":</h2>
    </div>

    <div class="row">
        <div class="col-md-6 mt-3 pl-0">
            <div class="card card-body">
                <form action="{{ route('substances.update', $substance->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" placeholder="Enter name" name="name"
                            value="{{ $substance->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Submit</button>
                </form>
                <form action="{{ route('substances.destroy', $substance->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger w-25" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
