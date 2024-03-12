@extends('admin.template')
@section('title', 'Schedule List')
@section('content')
    <main id="main" class="main">
        {{-- {{dd($data->toArray())}} --}}
        <h2 class="text-center">Schedule Lists-{{ $data->total() }}</h2>
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
                    <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Schedule Lists</li>
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
                            <th class="col-lg-2">ID</th>
                            <th class="col-lg-2">Name</th>
                            <th class="col-lg-2">Day</th>
                            <th class="col-lg-1">Start</th>
                            <th class="col-lg-1">End</th>
                            <th class="col-lg-2">Created_at</th>
                            <th class="col-lg-2">Edit/Delete</th>
                        </tr>
                    </thead>
                    {{-- for looping --}}
                    @foreach ($data as $scheduleData)
                        <tbody>
                            <tr class="">
                                <td>{{ $scheduleData->id }}</td>
                                <td>{{ $scheduleData->doctorName }}</td>
                                <td>{{$scheduleData->day}}</td>
                                <td>{{$scheduleData->start_time}}</td>
                                <td>{{$scheduleData->end_time}}</td>
                                <td>{{ $scheduleData->created_at->format('j / F / Y') }}</td>
                                <td>
                                    <div class="mt-3">
                                        <a href="{{route('admin.schedule.edit',$scheduleData->id)}}">
                                            <button class="btn btn-warning me-2" title="schedule edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('admin.schedule.delete',$scheduleData->id)}}">
                                            <button class="btn btn-danger" title=scheduler delete">
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
