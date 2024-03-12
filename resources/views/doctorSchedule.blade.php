@extends('template')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="row container text-center">
        <div class="col-12" style="margin: 200px">
            <div class=" container-fluid mt-3">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th class="col-lg-2">Doctor Name</th>
                            <th class="col-lg-2">Date</th>
                            <th class="col-lg-2">Start Time</th>
                            <th class="col-lg-2">End Time</th>
                            <th class="col-lg-2">Appointment</th>
                        </tr>
                    </thead>
                    {{-- for looping --}}
                    @foreach ($data as $appointData)
                        <tbody>
                            <tr>
                                <td>{{ $appointData->doctorName }}</td>
                                <td>{{ $appointData->day }}</td>
                                <td>{{ $appointData->start_time }}</td>
                                <td>{{ $appointData->end_time }}</td>
                                <td>
                                    @if (Auth::user())
                                        @if (Auth::user()->role == 'user')
                                            <div class="d-flex">
                                                <button class="appointBtn btn btn-info" id="appointBtn">Appointment
                                                </button>
                                                <input type="hidden" name="userId" id="userId"
                                                    value="{{ Auth::user()->id }}">
                                                @foreach ($d as $doctor)
                                                    <input type="hidden" name="doctorId" id="doctorId" value="{{$doctor->id}}">
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div class="alert alert-primary" role="alert">
                                            Please Login and Register <a href="{{ route('login') }}"
                                                class="alert-link"><strong>LogIn</strong></a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
@section('ajax')
    <script>
        $('doctument').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // for appoint ment
            $('.appointBtn').click(function() {
                let userId = $('#userId').val();
                let doctorId = $('#doctorId').val();
                console.log(userId);
                console.log(doctorId);
            });
        })
    </script>
@endsection
