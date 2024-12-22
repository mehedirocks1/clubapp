@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'Our Branches') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<div class="container my-5">
  <h2 class="text-center mb-4">Our Branch Offices</h2>
  
  <!-- Branch 1 -->
  <div class="card mb-4">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="https://via.placeholder.com/400x300" class="img-fluid rounded-start" alt="Branch 1">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Branch 1: New York</h5>
          <p class="card-text">Located in the heart of New York, this branch is our flagship office offering a range of services. The office is accessible and provides top-notch facilities for our clients and staff.</p>
          <ul>
            <li><strong>Address:</strong> 123 Main Street, New York, NY 10001</li>
            <li><strong>Phone:</strong> +1 234 567 890</li>
            <li><strong>Email:</strong> newyork@company.com</li>
            <li><strong>Working Hours:</strong> Mon-Fri, 9 AM - 6 PM</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Branch 2 -->
  <div class="card mb-4">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="https://via.placeholder.com/400x300" class="img-fluid rounded-start" alt="Branch 2">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Branch 2: London</h5>
          <p class="card-text">Our London branch is a vital part of our global presence. Located in the business district, it serves both local and international clients with excellent services.</p>
          <ul>
            <li><strong>Address:</strong> 456 Oxford Street, London, UK</li>
            <li><strong>Phone:</strong> +44 123 456 789</li>
            <li><strong>Email:</strong> london@company.com</li>
            <li><strong>Working Hours:</strong> Mon-Fri, 9 AM - 6 PM</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Branch 3 -->
  <div class="card mb-4">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="https://via.placeholder.com/400x300" class="img-fluid rounded-start" alt="Branch 3">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Branch 3: Tokyo</h5>
          <p class="card-text">The Tokyo branch is located in the bustling area of Shibuya, providing services to our clients in Japan and the Asia-Pacific region. It is known for its modern facilities and excellent customer service.</p>
          <ul>
            <li><strong>Address:</strong> 789 Shibuya Street, Tokyo, Japan</li>
            <li><strong>Phone:</strong> +81 3 1234 5678</li>
            <li><strong>Email:</strong> tokyo@company.com</li>
            <li><strong>Working Hours:</strong> Mon-Fri, 9 AM - 6 PM</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection <!-- End the content section -->
