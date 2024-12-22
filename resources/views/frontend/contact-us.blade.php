@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'Contact Us') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<div class="container my-5">
  <h2 class="text-center mb-4">Contact Us</h2>

  <div class="row">
    <!-- Contact Form -->
    <div class="col-md-8">
      <h4>Send us a Message</h4>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Subject</label>
          <input type="text" class="form-control" id="subject" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>

    <!-- Contact Information -->
    <div class="col-md-4">
      <h4>Our Contact Information</h4>
      <ul class="list-unstyled">
        <li><strong>Address:</strong> 123 Main Street, New York, NY 10001</li>
        <li><strong>Phone:</strong> +1 234 567 890</li>
        <li><strong>Email:</strong> contact@company.com</li>
        <li><strong>Working Hours:</strong> Mon-Fri, 9 AM - 6 PM</li>
      </ul>
    </div>
  </div>
</div>

@endsection <!-- End the content section -->
