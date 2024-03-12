@extends('admin.template')
@section('title', 'User List')
@section('content')
    <main id="main" class="main">
        {{-- {{dd($data->toArray())}} --}}
        <h2 class="text-center">User Lists-{{ $data->total() }}</h2>
        {{-- for pagination --}}
        <div>
            {{ $data->links() }}
        </div>
        {{-- for success message --}}
        @if (session('success'))
            <div class="alert alert-warning text-center d-flex justify-content-center align-items-center" role="alert">
                <i class="fa-solid fa-circle-check me-2 fs-2"></i>{{ session('success') }}
            </div>
        @endif
        {{-- for breadcrumb --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Admin Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Lists</li>
                </ol>
            </nav>
        </div>
        @if (count($data) == 0)
            <h2>There is <strong><i class=" text-primary">No Data!</i></strong></h2>
        @else
            {{-- for table --}}
            <div class=" container-fluid mt-3">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th class="col-lg-1">ID</th>
                            <th class="col-lg-1">Name</th>
                            <th class="col-lg-2">Email</th>
                            <th class="col-lg-1">Gender</th>
                            <th class="col-lg-2">Phone</th>
                            <th class="col-lg-1">Age</th>
                            <th class="col-lg-1">Create_at</th>
                            <th class="col-lg-2">Edit/Delete</th>
                        </tr>
                    </thead>
                    {{-- for looping --}}
                    @foreach ($data as $userData)
                        <tbody>
                            <tr class="">
                                <td>{{ $userData->id }}</td>
                                <td>{{ $userData->name }}</td>
                                <td>{{$userData->email}}</td>
                                <td>{{$userData->gender}}</td>
                                <td>{{$userData->phone}}</td>
                                <td>{{$userData->age}}</td>
                                <td>{{ $userData->created_at->format('j / F / Y') }}</td>
                                <td>
                                    <div class="">
                                        <a href="{{route('user.change',$userData->id)}}">
                                            <button class="btn btn-info" title="change to admin">
                                                <i class="fa-solid fa-user-tie"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('user.delete',$userData->id)}}">
                                            <button class="btn btn-danger" title=" delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        @endif
    </main>
@endsection
