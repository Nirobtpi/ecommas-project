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
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
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
                                        <a data-link="{{ route('post.delete', $post->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@endsection
