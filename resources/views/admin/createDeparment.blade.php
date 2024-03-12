@extends('admin.template')
@section('title', 'Create Deparment')
@section('content')
    <main class="main" id="main">
        <h2 class="text-center">Create Category</h2>
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Deparments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Deparment</li>
                </ol>
            </nav>
        </div>
        {{-- for form --}}
        <div class=" container-fluid">
            <div class=" col-lg-6 offset-3">
                {{-- for success message --}}
                @if (session('success'))
                    <div class="alert alert-warning text-center d-flex justify-content-center align-items-center" role="alert">
                        <i class="fa-solid fa-circle-check me-2 fs-2"></i>{{session('success')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <strong><i>Create Deparment</i></strong>
                        </div>
                        <div class=" form">
                            <form action="{{route('admin.create.data')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                {{-- for name --}}
                                <div class="form-group mb-3">
                                    <input class="form-control @error('deparmentName') is-invalid @enderror"
                                        type="text" name="deparmentName" id="deparmentName" placeholder="Deparment Name">
                                    @error('deparmentName')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- for description --}}
                                <div class="form-group mb-3">
                                    <textarea class="form-control @error('deparmentDescription') is-invalid @enderror" name="deparmentDescription"
                                        id="deparmentDescription" cols="30" rows="3" placeholder="Description"></textarea>
                                    @error('deparmentDescription')
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
