@extends('admin.template')
@section('title', 'Schedule Edit')
@section('content')
    <main class="main" id="main">
        <h2 class="text-center">Edit Schedule-{{ $data->id }}</h2>
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.create.deparment') }}">Schedule</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.deparment.list') }}">Schedule
                            Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Schedule</li>
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
                            <strong><i>Edit Schedule</i></strong>
                        </div>
                        <div class=" form">
                            <form action="{{route('admin.shcedule.update',$data->id)}}" method="post">
                                @csrf
                                {{-- doctor name --}}
                                <div class=" form-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="doctorName"
                                        id="doctorName">
                                        <option>Select the Doctor Name</option>
                                        @foreach ($doctData as $doctorData)
                                            <option @if ($doctorData->id == $data->doctor_id) selected @endif value="{{ $doctorData->id }}">{{ $doctorData->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- deparment --}}
                                <div class=" form-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="deparment"
                                        id="deparment">
                                        <option>Select the Deparment</option>
                                        @foreach ($deparData as $deparmentData)
                                            <option @if ($deparmentData->id == $data->deparment_id) selected @endif value="{{ $deparmentData->id }}">{{ $deparmentData->deparment }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- day --}}
                                <div class="form-group mb-3">
                                    <label for="day">Select Day</label>
                                    <input type="date" name="day" id="day"
                                        class="form-control  @error('day') is-invalid @enderror" value="{{old('day',$data->day)}}">
                                </div>
                                {{-- for start time --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('start') is-invalid @enderror" type="text"
                                        name="start" id="start" value="{{old('start',$data->start_time)}}">
                                    @error('start')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- end time --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('end') is-invalid @enderror" type="text"
                                        name="end" id="end" value="{{old('end',$data->end_time)}}">
                                    @error('end')
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
