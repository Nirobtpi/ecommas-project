@extends('layouts.admin')
@section('title', 'Add Category')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card table-responsive">
                <div class="card-body">
                    {{-- @if (session('delete'))
                        <div class="alert alert-danger m-2">{{ session('delete') }}</div>
                    @endif --}}
                    @if (session('cat_update'))
                        <div class="alert alert-success m-2">{{ session('cat_update') }}</div>
                    @endif
                    @if (session('retore'))
                        <div class="alert alert-success m-2">{{ session('retore') }}</div>
                    @endif
                    @if (session('forceDelete'))
                        <div class="alert alert-success m-2">{{ session('forceDelete') }}</div>
                    @endif
                    <h5 class="card-title">All categorys</h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->category_image == '')
                                            <img style="width: 60px; height:60px"
                                                src="{{ asset('admin_assets/img/profile-img.jpg') }}" alt="Profile"
                                                class="rounded-circle">
                                        @else
                                            <img style="width: 60px; height:60px"
                                                src="{{ asset('uploads/category') }}/{{ $category->category_image }}"
                                                alt="" class="rounded-circle">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <a data-link="{{ route('category.delete', $category->id) }}"
                                            class="btn btn-sm btn-danger del">Delete</a>
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
                <div class="card-body">
                    @if (session('add_cat'))
                        <div class="alert alert-success mt-2">{{ session('add_cat') }}</div>
                    @endif
                    <h5 class="card-title">Add New Category</h5>

                    <form class="row g-3" action="{{ route('category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="photo" class="form-label">Category Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo"
                                onchange="document.getElementById('nirob').src = window.URL.createObjectURL(this.files[0])">
                            <div class="mt-2">
                                <img src="" width="60px" alt="" id="nirob">
                            </div>
                            @error('photo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $('.del').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('data-link');
                    window.location.href = link
                }
            });
        })
    </script>

    @if (session('delete'))
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "{{ session('delete') }}",
                icon: "success"
            });
        </script>
    @endif

@endsection
