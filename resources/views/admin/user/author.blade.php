@extends('layouts.admin')
@section('title', 'All Author List')
@section('content')
    <div class="row">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title">All AUthors</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->email }}</td>
                                <td>
                                    @if ($author->status == 1)
                                        <span class='badge  bg-success'>Active</span>
                                    @else
                                        <span class='badge  bg-danger'>Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($author->photo == '')
                                        <img style="width: 60px; height:60px"
                                            src="{{ asset('admin_assets/img/profile-img.jpg') }}" alt="Profile"
                                            class="rounded-circle">
                                    @else
                                        <img style="width: 60px; height:60px"
                                            src="{{ asset('uploads/author') }}/{{ $author->photo }}" alt=""
                                            class="rounded-circle">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.author.satus', $author->id) }}"
                                        class="btn btn-sm btn-{{ $author->status == 1 ? 'success' : 'primary' }}">{{ $author->status == 1 ? 'Deactive Author' : 'Active Author' }}</a>
                                    <a data-link="{{ route('admin.author.delete', $author->id) }}"
                                        class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>
    </div>
@endsection

@section('script')

  <script>
    $('.delete').click(function(){
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

    @if (session('status'))
        {
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('status') }}",
                icon: "success"
            });
        </script>
        }
    @endif
    @if (session('delete'))
        {
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('delete') }}",
                icon: "success"
            });
        </script>
        }
    @endif
@endsection
