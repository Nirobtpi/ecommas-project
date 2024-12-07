@extends('frontend.author.authore_main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table with stripped rows</h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Sl Number</th>
                                <th scope="col">Title</th>
                                <th scope="col">Preview</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index=>$post)
                                <tr>
                                    <th scope="row">{{ $posts->firstitem() + $index }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td><img width="60px" height="60px"
                                            src="{{ asset('uploads/post/thumbnail') . '/' . $post->thumbnail_image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <p class="badge  bg-{{ $post->status == 1 ? 'success' : 'info' }}">
                                            {{ $post->status == 1 ? 'Publised' : 'Pending' }}</p>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="{{ route('post.active', $post->id) }}"
                                            class="btn btn-{{ $post->status == 1 ? 'success' : 'primary' }}">{{ $post->status == 1 ? 'Deactive' : 'Active' }}</a>
                                        <a data-link="{{ route('post.delete', $post->id) }}"
                                            class="btn btn-danger del-btn">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="mt-2">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('post_active'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('post_active') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    @if (session('post_deactive'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('post_deactive') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif


    <script>
        $('.del-btn').click(function() {
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
                    window.location.href = link;
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
