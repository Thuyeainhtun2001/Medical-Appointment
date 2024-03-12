@extends('admin.template')
@section('title', 'Patient List')
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
                    <li class="breadcrumb-item"><a href="#">Patient</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Patient Lists</li>
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
                            <th class="col-lg-2">USE ID</th>
                            <th class="col-lg-2">DOCTOR ID</th>
                            <th class="col-lg-2">FINISH</th>
                            <th class="col-lg-2">Created_at</th>
                            <th class="col-lg-2">Edit/Delete</th>
                        </tr>
                    </thead>
                    {{-- for looping --}}
                    @foreach ($data as $patientData)
                        <tbody>
                            <tr class="">
                                <td>{{ $patientData->id }}</td>
                                <td>{{ $patientData->user_id }}</td>
                                <td>{{$patientData->doctor_id}}</td>
                                <td>{{$patientData->finish}}</td>
                                <td>{{ $patientData->created_at->format('j / F / Y') }}</td>
                                <td>
                                    <div class="">
                                        @if ($patientData->finish == 0)
                                        <a href="{{route('patient.finish',$patientData->id)}}">
                                            <button class="btn btn-info">
                                                <i class="fa-solid fa-flag-checkered"></i>
                                            </button>
                                        </a>
                                        @else
                                        <a href="{{route('patient.delete',$patientData->id)}}">
                                            <button class="btn btn-danger" title=" delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>
                                        @endif
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
