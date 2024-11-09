@extends('layouts.admin')
@section('title', 'Category - trush')
@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table with stripped rows</h5>

                    <!-- Table with stripped rows -->
                    <form action="{{ route('category.check.restore') }}" method="POST" id="submitform">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">
                                                Check All
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Category Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($delete_cat as $delete)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input checkrestore" name="category_id[]"
                                                    value="{{ $delete->id }}" type="checkbox" id="retore">
                                            </div>
                                        </td>
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
                        <div class="my-2">
                            <button type="submit" name="action_btn" value="1" class='btn btn-info restoreall d-none'>Restore All</button>
                            <button name="action_btn" value="2" class='btn btn-danger restoreall d-none'>Delete All</button>
                        </div>
                    </form>
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
                    var link = $(this).attr('data-link');
                    window.location.href = link
                }
            });
        });
    </script>

    @if (session('forceDelete'))
        {
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "{{ session('forceDelete') }}",
                icon: "success"
            });
        </script>
    @endif
    }

    @if (session('retore'))
        {
        <script>
            Swal.fire({
                title: "Restore Success!",
                text: "{{ session('forceDelete') }}",
                icon: "success"
            });
        </script>
    @endif
    }

    {{-- select all check box  --}}
    <script>
        $('#checkAll').click(function() {
            $('.checkrestore').prop('checked', this.checked);
            $('.restoreall').toggleClass('d-none');
        })
        $('.checkrestore').click(function() {
            $('.restoreall').removeClass('d-none');
        })

        // form submit 
        // $('.restore').click(function() {
        //     event.preventDefault()
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, restore it!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $('#submitform').submit();
        //         }
        //     });
        // });
    </script>

@endsection
