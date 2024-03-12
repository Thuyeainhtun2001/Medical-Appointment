@extends('admin.template')
@section('title', 'Create Deparment')
@section('content')
    <main class="main" id="main">
        <h2 class="text-center">Create Doctor</h2>
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Doctors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Doctor</li>
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
                            <strong><i>Create Doctor</i></strong>
                        </div>
                        <div class=" form">
                            <form action="{{route('admin.doctor.create')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- image --}}
                                <div class="form-group mb-3">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                {{-- deparment --}}
                                <div class=" form-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="deparment" id="deparment">
                                        <option>Select the Deparment</option>
                                        @foreach ($data as $deparmentData)
                                        <option value="{{$deparmentData->id}}">{{$deparmentData->deparment}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- for name --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" id="name" placeholder="Doctor Name">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- degree --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('degree') is-invalid @enderror" type="text"
                                        name="degree" id="degree" placeholder="Doctor degree">
                                    @error('degree')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- experience --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('experience') is-invalid @enderror" type="text"
                                        name="experience" id="experience" placeholder="Doctor experience">
                                    @error('experience')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- history --}}
                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('history') is-invalid @enderror" name="history" id="history" cols="30"
                                        rows="3" placeholder="History"></textarea>
                                    @error('history')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- for btn --}}
                                <div class=" float-end">
                                    <input class="btn btn-success" type="submit" value="Create">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
