@extends('layouts.admin')
@section('title','Add Category')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if (session('add_cat'))
                        <div class="alert alert-success mt-2">{{ session('add_cat') }}</div>
                    @endif
                    <h5 class="card-title">Add New Category</h5>

                    <form class="row g-3" action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" value='{{ $category->name }}' name="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="photo" class="form-label">Category Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo"
                                onchange="document.getElementById('nirob').src = window.URL.createObjectURL(this.files[0])">

                            <div class="mt-3">
                                <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" width="60px" height="60px" alt="" id="nirob">
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
