@extends('template')
@section('content')
    <div style="margin: 200px">
        <div class="row gy-3 d-flex justify-content-evenly align-items-center">
            @foreach ($data as $showData)
                <div class="card" style="width: 20rem;">
                    @if ($showData->image == null)
                        <div class="text-center">
                            <img class="p-3" src="{{ asset('images/noimage.png') }}" alt="no img" width="300px" height="250px">
                        </div>
                    @else
                        <div class="text-center">
                            <img class="p-3 rounded-3" src="{{ asset('storage/deparments/' . $showData->image) }}"
                                alt="no img" width="300px" height="250px">
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $showData->deparmentName }}</h5>
                        <h5 class="card-title">{{ $showData->name }}</h5>
                        <p class="card-text">{{ $showData->degree }}</p>
                        <p class="card-text">{{ $showData->history }}</p>
                        <a class="btn btn-info" href="{{route('doctor.timetable',$showData->id)}}">See TimeTable</a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
