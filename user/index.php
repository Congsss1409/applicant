<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Tracking Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
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
                                            echo "<td>
                                                    <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#viewModal" . $row['id'] . "'>View</button>
                                                  </td>";
                                            echo "</tr>";

                                            // View Modal
                                            echo "<div class='modal fade' id='viewModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='viewModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='viewModalLabel" . $row['id'] . "'>Applicant Details</h5>";
                                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p><b>Name:  " . $row['name'] . "</p>";
                                            echo "<p>Email: " . $row['email'] . "</p>";
                                            echo "<p>Position: " . $row['position'] . "</p>";
                                            echo "<p>Status: " . $row['status'] . "</p></b>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            


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

    <!-- Bootstrap 5 JavaScript (use your own preferred version) -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
