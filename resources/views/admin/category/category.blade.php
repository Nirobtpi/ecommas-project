@extends('layouts.admin')
@section('title', 'Add Category')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card table-responsive">
                <div class="card-body">
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
                    <form action="{{ route('category.froceCheckDelete') }}" id='submitform' method="POST">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="chkSelectAll">
                                            <label class="form-check-label" for="chkSelectAll">
                                                Check All
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input chkDel" name="category_id[]"
                                                    value="{{ $category->id }}" type="checkbox" id="gridCheck1">
                                        </td>
                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::title($category->name) }}</td>
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
                        <div class="my-2">
                            <button  class="btn btn-danger del-check d-none">Delete All</button>
                        </div>
                    </form>
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

    <script>
        // check all button 
        $("#chkSelectAll").on('click', function() {
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
            $('.del-check').toggleClass('d-none');
        })
        // single check button show 
        $(".chkDel").on('click', function() {
            $('.del-check').removeClass('d-none');
        })
        // check delete form submit 
        $('.del-check').click(function(event) {
            event.preventDefault();
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
                    $('#submitform').submit();  // Submit form on confirmation
                }
            });
        });

    </script>

    @if (session('check_del')){
        <script>
            Swal.fire({
            title: "Deleted!",
            text: "{{ session('check_del') }}",
            icon: "success"
        });
        </script>
    }
        
    @endif

@endsection
