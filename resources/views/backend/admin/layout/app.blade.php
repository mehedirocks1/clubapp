<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/styles/adminstyles.css') }}">
</head>
<body>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar">
                <h4>Dashboard</h4>
                <ul class="nav flex-column">
                    <!-- Manage Users -->
                    <li class="nav-item">
                        <a href="#manageUsersMenu" data-bs-toggle="collapse">Manage Users</a>
                        <div class="collapse submenu" id="manageUsersMenu">
                            <a href="#" class="nav-link">View Roles</a>
                            <a href="#" class="nav-link">View Users</a>
                            <a href="#" class="nav-link">Menu Permission</a>
                            <a href="#" class="nav-link">Add User/Admin</a>
                        </div>
                    </li>

                    <!-- Manage Profile -->
                    <li class="nav-item">
                        <a href="#manageProfileMenu" data-bs-toggle="collapse">Manage Profile</a>
                        <div class="collapse submenu" id="manageProfileMenu">
                            <a href="{{ route('admin.viewProfile') }}" class="nav-link">Your Profile</a>
                            <a href="{{ route('admin.editProfile') }}" class="nav-link">Edit Profile</a>
                            <a href="{{ route('admin.changePassword') }}" class="nav-link">Change Password</a>
                        </div>
                    </li>

                    <!-- Site Settings -->
                    <li class="nav-item">
                        <a href="#siteSettingsMenu" data-bs-toggle="collapse">Site Settings</a>
                        <div class="collapse submenu" id="siteSettingsMenu">
                            <a href="{{ route('admin.changeLogo') }}" class="nav-link">Change Logo</a>
                            <a href="{{ route('admin.viewContact') }}" class="nav-link">View Contact</a>
                            <a href="{{ route('admin.viewSlider') }}" class="nav-link">View Slider</a>
                            <a href="{{ route('admin.viewAbout') }}" class="nav-link">View About</a>
                        </div>
                    </li>

                    <!-- Manage Members -->
                    <li class="nav-item">
                        <a href="#manageMembersMenu" data-bs-toggle="collapse">Manage Members</a>
                        <div class="collapse submenu" id="manageMembersMenu">
                            <a href="{{ route('admin.viewMembers') }}" class="nav-link">View Members</a>
                        </div>
                    </li>

                  <!-- Branches -->
<!-- Branches -->
<li class="nav-item">
    <a href="#branchesMenu" data-bs-toggle="collapse">Branches</a>
    <div class="collapse submenu" id="branchesMenu">
        <a href="{{ route('admin.branches') }}" class="nav-link">View Branches</a> <!-- Corrected link -->
        <a href="{{ route('admin.createBranch') }}" class="nav-link">Add Branches</a> <!-- Link for adding branches -->
    </div>
</li>


                    <!-- Gallery -->
                    <li class="nav-item">
                        <a href="#galleryMenu" data-bs-toggle="collapse">Gallery</a>
                        <div class="collapse submenu" id="galleryMenu">
                            <a href="{{ route('admin.gallery') }}" class="nav-link">View Gallery</a>
                            <a href="#" class="nav-link">Add to Gallery</a>
                            <a href="#" class="nav-link">Edit from Gallery</a>
                            <a href="#" class="nav-link">Delete from Gallery</a>
                        </div>
                    </li>

                </ul>
            </div>

            <!-- Main Content -->
            <div class="col main-content">
                <!-- Header -->
                <div class="header">
                    <h1>Welcome to Admin Dashboard</h1>
                    <div class="user-info">
                        <span>Admin Name</span>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

</html>
