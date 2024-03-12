@extends('admin.template')
@section('title', 'Doctor Edit')
@section('content')
    <main class="main" id="main">
        <h2 class="text-center">Edit Doctor-{{ $doctorData->id }}</h2>
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.doctor.create') }}">Doctor</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.doctor.list') }}">Doctor
                            Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Doctor</li>
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
                            <strong><i>Edit Doctor</i></strong>
                        </div>
                        <div>
                            @if ($doctorData->image == null)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('images/noimage.png') }}" alt="no img" width="300px"
                                        height="250px">
                                </div>
                            @else
                                <div class="text-center mb-3">
                                    <img class="my-3 rounded-3" src="{{ asset('storage/deparments/' . $doctorData->image) }}"
                                        alt="no img" width="300px" height="250px">
                                </div>
                            @endif
                        </div>
                        <div class=" form">
                            <form action="{{route('admin.doctor.update',$doctorData->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- image --}}
                                <div class="form-group mb-3">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                {{-- deparment --}}
                                <div class=" form-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="deparment"
                                        id="deparment">
                                        <option>Select the Deparment</option>
                                        @foreach ($deparmentData as $data)
                                            <option @if ($doctorData->deparment_id == $data->id) selected @endif value="{{ $data->id }}">{{ $data->deparment }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- for name --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" id="name" value="{{old('name',$doctorData->name)}}">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- degree --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('degree') is-invalid @enderror" type="text"
                                        name="degree" id="degree" value="{{old('degree',$doctorData->degree)}}">
                                    @error('degree')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- experience --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('experience') is-invalid @enderror" type="text"
                                        name="experience" id="experience" value="{{old('experience',$doctorData->experience)}}">
                                    @error('experience')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- history --}}
                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('history') is-invalid @enderror" name="history" id="history" cols="30"
                                        rows="3">{{old('history',$doctorData->history)}}</textarea>
                                    @error('history')
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
