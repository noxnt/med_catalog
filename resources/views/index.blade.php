@extends('layouts.main')
@section('content')
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6 text-center">
                <h2>Main page</h2>
                <hr class="w-100 mb-1">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto justify-content-center w-100">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('products.index') }}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('substances.index') }}">Substances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('makers.index') }}">Makers</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
    </div>
@endsection
