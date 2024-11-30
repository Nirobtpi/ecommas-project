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
                                    <td>Designer</td>
                                    <td>
                                        <p class="badge  bg-{{ $post->status == 1 ? 'success' : 'info' }}">
                                            {{ $post->status == 1 ? 'Publised' : 'Pending' }}</p>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
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
