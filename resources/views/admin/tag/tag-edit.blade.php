@extends('layouts.admin')
@section('title', 'Tag Edit')

@section('content')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Tag Form</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="{{ route('tag.update', $tag->id) }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Your Name</label>
                        <input type="text" name="name" value="{{ $tag->name }}" class="form-control"
                            id="inputNanme4">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update Tag</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
