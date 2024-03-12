@extends('admin.template')
@section('title', 'Deparment Detail')
@section('content')
    <main class="main" id="main">
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Deparment</a></li>
                    <li class="breadcrumb-item"><a href="#">Deparment list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">details</li>
                </ol>
            </nav>
        </div>
        {{-- for card --}}
        <div class="card mx-auto" style="width: 600px">
            @if ($data->image == null)
                <div class="text-center mb-3">
                    <img src="{{ asset('images/noimage.png') }}" alt="no img" width="300px" height="250px">
                </div>
            @else
                <div class="text-center mb-3">
                    <img class="my-3 rounded-3" src="{{ asset('storage/deparments/' . $data->image) }}" alt="no img"
                        width="300px" height="250px">
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $data->deparment }}</h5>
                <p class="card-text">{{ $data->description }}</p>
            </div>
            <div>
                <a href="{{ route('admin.deparment.list') }}">
                    <button class="btn btn-secondary float-end my-2 me-2">
                        <i class="fa-solid fa-arrow-left fs-5 text-white"></i>
                    </button>
                </a>
            </div>
        </div>
    </main>
@endsection
