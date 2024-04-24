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
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" alt="ATS Logo" height="50">
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
                            <a href="add_application.php" class="btn btn-success btn-block">Add Applicant</a>
                        </li>
                        <br>
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
                                    <?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'applicant');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM applications";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['position'] . "</td>";
        echo "<td><a href='view_application.php?id=" . $row['id'] . "' class='btn btn-info'>View</a>
        <a href='edit_application.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
        <a href='delete_application.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No applications found</td></tr>";
}

mysqli_close($conn);
?>
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
