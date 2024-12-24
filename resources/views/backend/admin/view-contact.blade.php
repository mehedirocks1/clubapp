@extends('backend.admin.layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Contact Information</h1>

        @if ($contactInfo)
            <div class="mb-3">
                <p><strong>Full Name:</strong> {{ $contactInfo->full_name }}</p>
                <p><strong>Address:</strong> {{ $contactInfo->address }}</p>
                <p><strong>Phone:</strong> {{ $contactInfo->phone }}</p>
                <p><strong>Working Hours:</strong> {{ $contactInfo->working_hours }}</p>
            </div>
        @else
            <p>No contact information available.</p>
        @endif

        <div class="mt-4">
            <p><strong>Total Contacts:</strong> {{ $totalContacts }}</p>
        </div>
    </div>
@endsection
