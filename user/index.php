<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Tracking Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #6c757d;
            color: white;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .main-content {
            padding-top: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        /* End Custom Styles */
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="bomba.png" alt="ATS Logo" height="50">
            </a>
            
            <h1 class="m-auto">Applicant Tracking Management System</h1>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <br>
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a href="../index.php" class="btn btn-danger btn-block">Log Out</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Applicant List</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Applicant ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'list_applications.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JavaScript (use your own preferred version) -->
    <script src="bootstrap.bundle.min.js"></script> 
</body>
</html>
