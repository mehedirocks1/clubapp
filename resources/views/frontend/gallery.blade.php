@extends('frontend.layout.app') <!-- Extend the main layout -->

@section('title', 'Gallery Page') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<div class="container my-5">
  <h2 class="text-center">Image Gallery</h2>
  <div class="row g-4">
    <!-- Gallery Item 1 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 1">
        <div class="card-body">
          <p class="card-text">Image 1 Description</p>
        </div>
      </div>
    </div>

    <!-- Gallery Item 2 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 2">
        <div class="card-body">
          <p class="card-text">Image 2 Description</p>
        </div>
      </div>
    </div>

    <!-- Gallery Item 3 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 3">
        <div class="card-body">
          <p class="card-text">Image 3 Description</p>
        </div>
      </div>
    </div>

    <!-- Gallery Item 4 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 4">
        <div class="card-body">
          <p class="card-text">Image 4 Description</p>
        </div>
      </div>
    </div>

    <!-- Gallery Item 5 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 5">
        <div class="card-body">
          <p class="card-text">Image 5 Description</p>
        </div>
      </div>
    </div>

    <!-- Gallery Item 6 -->
    <div class="col-md-4 col-sm-6">
      <div class="card">
        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image 6">
        <div class="card-body">
          <p class="card-text">Image 6 Description</p>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection <!-- End the content section -->
