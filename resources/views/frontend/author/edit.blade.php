@extends('frontend.author.authore_main');
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Data</h5>
                    @if (session('update'))
                        <div class="alert alert-success">
                            {{ session('update') }}
                        </div>
                    @endif
                    <form class="row g-3" action="{{ route('author.update', Auth::guard('author')->user()->id) }}"
                        method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" value="{{ Auth::guard('author')->user()->name }}" name="name"
                                class="form-control" id="name">
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" value="{{ Auth::guard('author')->user()->email }}" readonly
                                class="form-control" id="inputEmail4">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update Author</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Password</h5>
                    @if (session('password_success'))
                        <div class="alert alert-success">
                            {{ session('password_success') }}
                        </div>
                    @endif
                    @if (session('old_pass'))
                        <div class="alert alert-danger">
                            {{ session('old_pass') }}
                        </div>
                    @endif
                    <form class="row g-3" action="{{ route('author.update.password', Auth::guard('author')->user()->id) }}"
                        method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="old_password">
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirm_password">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
@endsection
