@extends('layouts.admin')
@section('title','Add Category')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-4">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Category</h5>
              
              <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                  <label for="name" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-12">
                  <label for="photo" class="form-label">Category Photo</label>
                  <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
    </div>
</div>
    
@endsection