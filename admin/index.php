<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Tracking Management System</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
        background-color: ;
        }
        .containerH {
        display: flex;
        align-items: center; /* Align items vertically in the center */
        padding: 20px;
    }

    .header-brand img {
        margin-left: 50px; /* Adjust margin as needed */
    }
        .navbar-custom {
            background-color: #6c757d;
            color: white;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            padding-top: 20px;
            transition: left 0.3s ease;
        }
        .sidebar .nav-item {
    margin-bottom: 10px;
}

.sidebar .btn {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
}

.sidebar .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    margin-left: 10px;
}

.sidebar .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.sidebar .btn-outline-secondary {
    margin-left: 10px;
    color: red;
    border-color: red;
}

.sidebar .btn-outline-secondary:hover {
    color: #495057;
    background-color: #e2e3e5;
    border-color: #d6d8db;
}
        .sidebar.active {
            left: 0;
        }
        .main-content {
            margin-right: auto; /* Adjust this value based on the width of the sidebar */
            padding-top: 1px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .burger-menu {
            cursor: pointer;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 9999;
            background-color:black;
        }
        .burger-menu span {
            background-color: #fff;
            display: block;
            margin: 4px 0;
            height: 2px;
            width: 25px;
            transition: all 0.3s ease;
        }
        .burger-menu.active span:nth-child(2) {
            opacity: 0;
        }
        .burger-menu.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .burger-menu.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
    </style>
</head>
<header class="header">
    <div class="containerH">
        <a class="header-brand" href="index.php">
            <img src="logo.png" alt="ATS Logo" height="50">
        
        </a>
        <h1 class="header-title m-auto">Applicant Tracking Management System</h1>
    </div>
</header>


<body>
    
    <div class="burger-menu" id="burgerMenu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <ul class="nav flex-column">
        <br>
        <br>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addApplicantModal">Add Applicant</button>
        </li>
        <li class="nav-item">
            <a href="../index.php" class="btn btn-outline-secondary btn-block">Log Out</a>
        </li>
        <!-- Add more sidebar links as needed -->
    </ul>
</div>

    
            
            <!-- Add Applicant Modal -->
<div class="modal fade" id="addApplicantModal" tabindex="-1" role="dialog" aria-labelledby="addApplicantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="addApplicantModalLabel">Add Applicant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="add_application.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class='mb-3'>
        <label for='status' class='form-label'>Status</label>
        <select class='form-select' id='status' name='status' required>
        <option value='Pending' ". ($row['status'] == 'Pending' ? 'selected' : '') .">Pending</option>
        <option value='Accepted' ". ($row['status'] == 'Accepted' ? 'selected' : '') .">Accepted</option>
        <option value='Rejected' ". ($row['status'] == 'Rejected' ? 'selected' : '') .">Rejected</option>
        </select>
        </div>
                    <button type="submit" class="btn btn-success">Add Applicant</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<br>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    
                <div class="container mt-5">
                
    
                    <div class="card">
                        
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Applicant List</h5>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Applicant ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'applicant');
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
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td>
                                                    <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#viewModal" . $row['id'] . "'>View</button>
                                                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Update</button>
                                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'>Delete</button>
                                                  </td>";
                                            echo "</tr>";
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

                                            // Edit Modal
        echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>";
        echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Update Applicant</h5>";
        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "<form method='POST' action='edit_application.php?id=" . $row['id'] . "'>"; // Form action updated
        echo "<div class='mb-3'>";
        echo "<label for='name' class='form-label'>Name</label>";
        echo "<input type='text' class='form-control' id='name' name='name' value='" . $row['name'] . "' required>"; // Input name updated
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='email' class='form-label'>Email</label>";
        echo "<input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "' required>"; // Input name updated
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='position' class='form-label'>Position</label>";
        echo "<input type='text' class='form-control' id='position' name='position' value='" . $row['position'] . "' required>"; // Input name updated
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='status' class='form-label'>Status</label>";
        echo "<select class='form-select' id='status' name='status' required>";
        echo "<option value='Pending' ". ($row['status'] == 'Pending' ? 'selected' : '') .">Pending</option>"; // Set default status to Pending
        echo "<option value='Accepted' ". ($row['status'] == 'Accepted' ? 'selected' : '') .">Accepted</option>";
        echo "<option value='Rejected' ". ($row['status'] == 'Rejected' ? 'selected' : '') .">Rejected</option>";
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Update</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

                                            // Delete Modal
echo "<div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel" . $row['id'] . "' aria-hidden='true'>";
echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='deleteModalLabel" . $row['id'] . "'>Confirm Deletion</h5>";
echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
echo "</div>";
echo "<div class='modal-body'>";
echo "Are you sure you want to delete this applicant?";
echo "</div>";
echo "<div class='modal-footer'>";
echo "<form method='POST' action='delete_application.php?id=" . $row['id'] . "'>"; // Form action updated
echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>"; // Changed to button type and removed form action
echo "<button type='submit' class='btn btn-danger'>Delete</button>"; // Changed to button type and removed form action
echo "</form>";
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
    <script>
        // JavaScript to toggle sidebar
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const burgerMenu = document.getElementById('burgerMenu');
            const mainContent = document.querySelector('.main-content');

            // Toggle sidebar visibility
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                mainContent.style.marginLeft = sidebar.classList.contains('active') ? '250px' : '0';
                burgerMenu.classList.toggle('active');
            }

            // Event listener for burger menu button
            burgerMenu.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>
