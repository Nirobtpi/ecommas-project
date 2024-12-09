@extends('frontend.author.authore_main')
@section('styles')
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
<style>
    #category {
        height: 34px;
        font-size: 14px;
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Post</h5>

                @if (session('add_post'))
                <div class="alert alert-success">
                    {{ session('add_post') }}
                </div>
                @endif

                <!-- Vertical Form -->
                <form class="row g-3" method="POST" action="{{ route('author.post.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="title" class="form-label">Title*</label>
                        <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description*</label>
                        <textarea name="description" value="{{ old('description') }}" id="description"
                            class="form-control" height='150px'></textarea>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="category" class="form-label">Category*</label>
                        <select id="category" name="category" class="form-select">
                            <option selected="">Choose...</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="read_time" class="form-label">Read Time</label>
                        <input type="number" value="{{ old('read_time') }}" name="read_time" class="form-control"
                            id="read_time" placeholder="1234">
                        @error('read_time')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="tag" class="form-label">Tags</label>
                        <select id="select-gear" class="demo-default" name="tag[]" multiple placeholder="Select Tag...">
                            <option value="">Select Tag...</option>
                            <optgroup>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach

                            </optgroup>
                        </select>
                        @error('tag')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="published_at" class="form-label">published Date</label>
                        <input type="date" name="published_at" class="form-control" id="published_at">
                        @error('published_at')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="preview_image" class="form-label">Preview Image</label>
                        <input type="file" name="preview_image" class="form-control" id="preview_image">
                        @error('preview_image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="thumbnail_image" class="form-label">Thumbnail Image</label>
                        <input type="file" name="thumbnail_image" class="form-control" id="thumbnail_image">
                        @error('thumbnail_image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Add Post</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
    $(document).ready(function () {
        $('#description').summernote({
            height: 200,
        });
        $('#select-gear').selectize({
            sortField: 'text'
        })
    });

</script>
@endsection
