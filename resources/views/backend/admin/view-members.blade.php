@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Registered Users</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered text-center">
        <thead class="table-primary">
          <tr>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Country</th>
            <th>District</th>
            <th>Address</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($members as $member)
          <tr>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            <td>{{ $member->mobile_number }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->country }}</td>
            <td>{{ $member->district }}</td>
            <td>{{ $member->address }}</td>
            <td>
              <form action="{{ route('admin.members.updateStatus', $member->id) }}" method="POST">
                  @csrf
                  @method('PUT') 
                  <button type="submit" class="btn btn-sm {{ $member->status == 1 ? 'btn-success' : 'btn-danger' }}">
                      <i class="bi {{ $member->status == 1 ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                  </button>
              </form>
            </td>
            <td>
              <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> 
              <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
              <a href="#" class="btn btn-sm btn-success"><i class="bi bi-chat-text"></i></a> 
              <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-envelope"></i></a>

              <!-- Delete Link -->
              <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); confirmDelete({{ $member->id }});">
                  <i class="bi bi-trash"></i>
              </a>

              <!-- Confirmation Modal (Hidden by default) -->
              <div id="confirmationModal" class="modal" style="display: none;">
                  <div class="modal-content">
                      <p>Are you sure you want to delete this member?</p>
                      <button id="confirmDeleteBtn" class="btn btn-danger" onclick="submitDelete();">Yes, Delete</button>
                      <button id="cancelDeleteBtn" class="btn btn-secondary" onclick="cancelDelete();">Cancel</button>
                  </div>
              </div>

              <!-- Delete Form (Hidden) -->
              <form id="delete-form" action="" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8">No users found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

<script>
    function confirmDelete(id) {
        // Show the modal
        document.getElementById('confirmationModal').style.display = 'block';
        // Set the action URL dynamically based on the member ID
        document.getElementById('delete-form').action = '/admin/members/' + id;
    }

    function submitDelete() {
        // Submit the form to delete the member
        document.getElementById('delete-form').submit();
    }

    function cancelDelete() {
        // Close the modal
        document.getElementById('confirmationModal').style.display = 'none';
    }
</script>
