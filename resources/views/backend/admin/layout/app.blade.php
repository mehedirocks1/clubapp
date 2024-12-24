<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 20px;
            height: 100%;
            position: fixed;
            width: 220px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .sidebar .nav-item a {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #495057;
        }

        .sidebar .nav-item a:hover {
            background-color: #17a2b8;
        }

        .submenu .nav-link {
            padding-left: 30px;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }

        .header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info span {
            margin-right: 15px;
        }

        .container-fluid {
            padding: 0;
            height: 100%;
        }

        .row {
            height: 100%;
        }

        /* Adjust navbar for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                height: auto;
                width: 100%;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
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
    <a href="{{ route('admin.branches') }}" class="nav-link">Branches</a>
    <a href="{{ route('admin.viewAbout') }}" class="nav-link">View About</a>
    <a href="{{ route('admin.gallery') }}" class="nav-link">Gallery</a>
                        </div>
                    </li>

                    <!-- Manage Members -->
                    <li class="nav-item">
                        <a href="#manageMembersMenu" data-bs-toggle="collapse">Manage Members</a>
                        <div class="collapse submenu" id="manageMembersMenu">
                            <a href="{{ route('admin.viewMembers') }}" class="nav-link">View Members</a>
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
