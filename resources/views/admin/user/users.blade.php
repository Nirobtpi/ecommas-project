@extends('layouts.admin')
@section('title','Users')

@section('content')
<div class="row">
    <div class="col-lg-8">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title">All Users</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->photo == '')
                                     <img style="width: 60px; height:60px" src="{{ asset('admin_assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                                @else
                                <img style="width: 60px; height:60px"
                                    src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="" class="rounded-circle">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.delete',$user->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            @if (session('add_user'))
                <div class="alert alert-success">
                    {{ session('add_user') }}
                </div>
            @endif
            <div class="card-body">
                <div class="card-header mb-3">
                    <h3>Add New User</h3>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('user.add') }}" method="POST">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                             @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                             @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                       
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
