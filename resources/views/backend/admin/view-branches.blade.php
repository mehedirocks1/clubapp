@extends('backend.admin.layout.app')

@section('content')
    <h1>Branches</h1>
    
    @if ($branches->isEmpty())
        <p>No branches found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Working Hours</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->description }}</td>
                            <td>{{ $branch->address }}</td>
                            <td>{{ $branch->phone }}</td>
                            <td>{{ $branch->email }}</td>
                            <td>{{ $branch->working_hours }}</td>
                            <td>
                                @if ($branch->image)
                                    <img src="{{ asset('storage/' . $branch->image) }}" alt="Branch Image" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $branch->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $branch->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@section('styles')
    <style>
        /* Optional: Add some padding and border for better design */
        .table td, .table th {
            padding: 12px;
            vertical-align: middle;
        }

        /* Optional: Add hover effect for rows */
        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Optional: Add style for image */
        img {
            border-radius: 8px;
        }
    </style>
@endsection
