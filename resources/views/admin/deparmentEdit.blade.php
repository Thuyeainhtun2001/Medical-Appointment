@extends('admin.template')
@section('title', 'Deparment Edit')
@section('content')
    <main class="main" id="main">
        <h2 class="text-center">Edit Deparment-{{ $data->id }}</h2>
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.create.deparment')}}">Deparment</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.deparment.list')}}">Deparment Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Deparment</li>
                </ol>
            </nav>
        </div>
        {{-- for form --}}
        <div class=" container-fluid">
            <div class=" col-lg-6 offset-3">
                {{-- for success message --}}
                @if (session('success'))
                    <div class="alert alert-warning text-center d-flex justify-content-center align-items-center"
                        role="alert">
                        <i class="fa-solid fa-circle-check me-2 fs-2"></i>{{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <strong><i>Edit Deparment</i></strong>
                        </div>
                        <div>
                            @if ($data->image == null)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('images/noimage.png') }}" alt="no img" width="300px"
                                        height="250px">
                                </div>
                            @else
                                <div class="text-center mb-3">
                                    <img class="my-3 rounded-3" src="{{ asset('storage/deparments/' . $data->image) }}"
                                        alt="no img" width="300px" height="250px">
                                </div>
                            @endif
                        </div>
                        <div class=" form">
                            <form action="{{route('admin.deparment.update',$data->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                {{-- for name --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('deparmentName') is-invalid @enderror" type="text"
                                        name="deparmentName" id="deparmentName" placeholder="Deparment Name"
                                        value="{{ old('deparmentName', $data->deparment) }}">
                                    @error('deparmentName')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- for description --}}
                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('deparmentDescription') is-invalid @enderror" name="deparmentDescription"
                                        id="deparmentDescription" cols="30" rows="3" placeholder="Description">{{ old('deparmentDescription', $data->description) }}</textarea>
                                    @error('deparmentDescription')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- for btn --}}
                                <div class=" float-end">
                                    <input class="btn btn-success" type="submit" value="UPDATE">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
