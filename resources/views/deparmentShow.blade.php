@extends('template')
@section('content')
    <div style="margin: 200px">
        <div class="row gy-3 d-flex justify-content-evenly">
            @foreach ($data as $showData)
                <div class="card p-3" style="width: 21rem;">
                    @if ($showData->image == null)
                        <div class="text-center">
                            <img src="{{ asset('images/noimage.png') }}" alt="no img" width="300px" height="250px">
                        </div>
                    @else
                        <div class="text-center">
                            <img class="rounded-4" src="{{ asset('storage/deparments/' . $showData->image) }}"
                                alt="no img" width="300px" height="250px">
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $showData->deparment }}</h5>
                        <p class="card-text">{{ $showData->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
