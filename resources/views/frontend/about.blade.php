@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'About Us') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<!-- About Section -->
<section class="about-us py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="display-4">About Us</h2>
                <p class="lead">We are a team of professionals dedicated to providing the best solutions for your business. Our mission is to innovate, create, and deliver exceptional results.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x300" class="img-fluid rounded" alt="About Us">
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="our-team py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x300" class="card-img-top" alt="Team Member 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">CEO & Founder</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x300" class="card-img-top" alt="Team Member 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jane Smith</h5>
                        <p class="card-text">CTO</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x300" class="card-img-top" alt="Team Member 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Alice Brown</h5>
                        <p class="card-text">Lead Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection <!-- End the content section -->
