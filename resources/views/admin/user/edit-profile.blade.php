@extends('layouts.admin');
@section('title', 'Edit Profile')
@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card text-start">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <h4> {{ session('success') }}</h4>
                            </div>
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">Edit Profile</h3>


                            <form class="row g-3" method="POST" action="{{ route('admin.update.profile', Auth::user()->id) }}">
                                @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="name"
                                        class="form-control" id="name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" readonly value="{{ Auth::user()->email }}"
                                        class="form-control" id="email" readonly>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card text-start">
                        <div class="card-body pt-2">
                            @if (session('photo'))
                                <div class="alert alert-success">
                                    <p> {{ session('photo') }}</p>
                                </div>
                            @endif
                            {{-- @if (session('error'))
                                <div class="alert alert-danger">
                                    <p> {{ session('error') }}</p>
                                </div>
                            @endif --}}
                            <h3 class="card-title">Update Photo</h3>
                            <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('admin.update.photo',Auth::user()->id) }}">
                                @csrf

                                <div class="col-12">
                                    <label for="photo" class="form-label">Update Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photo"
                                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <div class="my-2">
                                        <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" id='blah' width="200px" alt="">
                                    </div>
                                    @error('photo')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">Update Photo</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card text-start">
                        <div class="card-body pt-2">
                            @if (session('pass'))
                                <div class="alert alert-success">
                                    <p> {{ session('pass') }}</p>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <p> {{ session('error') }}</p>
                                </div>
                            @endif
                            <h3 class="card-title">Change Password</h3>
                            <form class="row g-3" method="POST"
                                action="{{ route('admin.update.password', Auth::user()->id) }}">
                                @csrf
                                <div class="col-12">
                                    <label for="password" class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="password">
                                    @error('old_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" id="new_password">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="confirm_password">
                                    @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
