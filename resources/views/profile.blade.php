@extends('template')
@section('title', 'profile')
@section('content')
    <div>
        <!-- Card Layout-->
        <div class="col-xl-8 mt-5 mx-auto">
            <div class="card" style="margin:200px">
                {{-- for success message --}}
                @if (session('success'))
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fa-solid fa-circle-check me-3 fs-5 text-primary"></i> {{ session('success') }}
                    </div>
                @endif
                {{-- for error message --}}
                @if (session('error'))
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fa-solid fa-circle-xmark me-3 fs-5 text-danger"></i> {{ session('error') }}
                    </div>
                @endif
                <div class="card-body pt-3">

                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item active">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                                Password</button>
                        </li>

                    </ul>

                    <div class="tab-content pt-2">
                        <!-- Overview Tab -->
                        <div class="show active tab-pane fade " id="profile">
                            <div class="row mt-2 mx-auto">
                                {{-- left side --}}
                                <div class="col-lg-4 text-center">
                                    {{-- for profile image --}}
                                    @if (Auth::user()->image == null)
                                        <img class="img img-fluid w-50 rounded-circle shadow  mb-2"
                                            src="{{ asset('images/noimage.png') }}" alt="no image">
                                    @else
                                        <img class="img img-fluid w-50 rounded-circle shadow  mb-2"
                                            src="{{ asset('/storage/profile/' . Auth::user()->image) }}" alt="no image">
                                    @endif
                                    <p><strong><i>{{ Auth::user()->name }}</i></strong></p>
                                </div>
                                {{-- right side --}}
                                <div class="col-lg-8 text-center col-12">
                                    {{-- for name --}}
                                    <div class="d-flex mb-3">
                                        <label class="me-3" for="name">Name:</label>
                                        <h5>
                                            {{ Auth::user()->name }}
                                        </h5>
                                    </div>
                                    {{-- for email --}}
                                    <div class="d-flex mb-3">
                                        <label class="me-3" for="email">Email:</label>
                                        <h5>
                                            {{ Auth::user()->email }}
                                        </h5>
                                    </div>
                                    {{-- age --}}
                                    <div class="d-flex mb-3">
                                        <label class="me-3" for="age">Age:</label>
                                        <h5>
                                            {{ Auth::user()->age }}
                                        </h5>
                                    </div>
                                    {{-- gender --}}
                                    <div class="d-flex mb-3">
                                        <label class="me-3" for="gender">Gender:</label>
                                        <h5>
                                            {{ Auth::user()->gender }}
                                        </h5>
                                    </div>
                                    {{-- address --}}
                                    <div class="d-flex mb-3">
                                        <label class="me-3" for="address">address:</label>
                                        <h5>
                                            {{ Auth::user()->address }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Overview Tab -->

                        <!-- Edit Profile Tab -->
                        <div class=" row tab-pane fade profile-edit pt-3" id="profile-edit">
                            <div class="col-lg-8 mx-auto">
                                <!-- Profile Edit Form -->
                                <form action="{{ route('editProfile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{-- for image --}}
                                    <div class="mb-3">
                                        <label for="image">Update Image</label>
                                        <input class="@error('image') is-invalid @enderror form-control w-50" type="file"
                                            name="image" id="image">
                                    </div>
                                    {{-- for name --}}
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input class="@error('name') is-invalid @enderror form-control w-50" type="text"
                                            name="name" id="name" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                    {{-- email --}}
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input class="@error('email') is-invalid @enderror form-control w-50" type="text"
                                            name="email" id="email" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                    {{-- age --}}
                                    <div class="mb-3">
                                        <label for="age">Age</label>
                                        <input class="@error('age') is-invalid @enderror form-control w-50" type="number"
                                            name="age" id="age" value="{{ old('age', Auth::user()->age) }}">
                                    </div>
                                    {{-- phone --}}
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input class="@error('phone') is-invalid @enderror form-control w-50" type="text"
                                            name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                    </div>
                                    {{-- address --}}
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror w-50" name="address" id="address" cols="30"
                                            rows="3">{{ old('address', Auth::user()->address) }}</textarea>
                                    </div>
                                    {{-- gender --}}
                                    <div class="mb-3">
                                        <label for="gender">Gender</label>
                                        <input class="@error('gender') is-invalid @enderror form-control w-50"
                                            type="text" name="gender" id="gender"
                                            value="{{ old('gender', Auth::user()->gender) }}">
                                    </div>
                                    {{-- btn --}}
                                    <div class="text-center">
                                        <button class="btn btn-primary">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- End Edit Profile Tab -->

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <!-- Profile Edit Form -->
                            <form action="{{ route('changePassword') }}" method="post">
                                @csrf
                                {{-- old password --}}
                                <div class="mb-3">
                                    <label for="oldPassword">Old Password</label>
                                    <input class="form-control w-50 @error('oldPassword') is-invalid @enderror"
                                        type="password" name="oldPassword" id="oldPassword">
                                </div>
                                {{-- new password --}}
                                <div class="mb-3">
                                    <label for="newPassword">New Password</label>
                                    <input class="form-control w-50 @error('oldPassword') is-invalid @enderror"
                                        type="password" name="newPassword" id="newPassword">
                                </div>
                                {{-- comfirm password --}}
                                <div class="mb-3">
                                    <label for="cmPassword">Comfirm Password</label>
                                    <input class="form-control w-50 @error('oldPassword') is-invalid @enderror"
                                        type="password" name="cmPassword" id="cmPassword">
                                </div>
                                {{-- for btn --}}
                                <div class="text-center">
                                    <button class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Change Password Tab -->
                    </div>

                </div>
            </div>
        </div>
        <!-- End Card Layout-->
    </div>
@endsection
