@extends('layouts.admin')
@section('title', 'Category - trush')
@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table with stripped rows</h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Category Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delete_cat as $delete)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $delete->name }}</td>
                                    <td><img width="60px"
                                            src="{{ asset('uploads/category') }}/{{ $delete->category_image }}"
                                            alt=""></td>
                                    <td>
                                        <a href="{{ route('category.restore', $delete->id) }}"
                                            class="btn btn-info">Restore</a>
                                        <a data-link="{{ route('category.froceDelete', $delete->id) }}"
                                            class="btn btn-danger del">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

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
               var link=$(this).attr('data-link');
               window.location.href=link
            }
        });
        });

        
    </script>

     @if(session('forceDelete')){
        <script>
            Swal.fire({
            title: "Deleted!",
            text: "{{ session('forceDelete') }}",
            icon: "success"
            });
        </script>
     @endif
    }
@endsection
