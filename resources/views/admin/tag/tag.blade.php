@extends('layouts.admin')
@section('title', 'tag laravel blog website')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Tags</h5>
                    <form action="{{ route('tag.checkdelete') }}" method="POST">
                        @csrf
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr scope="col">
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">
                                                Check All
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input name="tag_id[]" value="{{ $tag->id }}"
                                                    class="form-check-input check" type="checkbox" id="gridCheck1">
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <a href="" class="btn btn-info">Edit</a>
                                            <a data-link="{{ route('tag.softdelete', $tag->id) }}"
                                                class="btn btn-danger delete">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="4">
                                        <h3 class="text-center">No Data Available</h3>
                                    </td>
                                @endforelse


                            </tbody>
                        </table>
                        <div class="mt-2">
                            <button class="btn btn-danger all-delete d-none">Delete All</button>
                        </div>
                        <!-- End Primary Color Bordered Table -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Tag Form</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="inputNanme4">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Add Tag</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    @if (session('tag_add'))
        {
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('tag_add') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        }
    @endif

    <script>
        $('.delete').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                var link = $(this).attr('data-link');
                window.location.href = link;
            });
        })
    </script>

    @if (session('tag_delete'))
        {
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "{{ session('tag_delete') }}",
                icon: "success"
            });
        </script>
        }
    @endif

    <script>
        $("#checkAll").click(function() {
            // $('.check').prop('checked', this.checked);
            $(".check").prop('checked', $(this).prop("checked"));
            $('.all-delete').toggleClass('d-none')
        });
        $('.check').click(function(){
            $('.all-delete').removeClass('d-none')
        })
    </script>

@endsection
