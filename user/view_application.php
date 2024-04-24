<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'applicant');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM applications WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    // Check if application with given ID exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Application not found";
        exit();
    }
} else {
    echo "Invalid application ID";
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #6c757d;
            color: white;
        }
        .container {
            max-width: 800px;
            margin-top: 10px;
        }
        .table th, .table td {
            border-top: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="bomba.png" alt="ATS Logo" height="30">
            </a>
            <h1 class="m-auto">Applicant Tracking Management System</h1>
        </div>
    </nav>

    <!-- Application Details -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Applicant Details</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width: 200px;">Name:</th>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Position:</th>
                        <td><?php echo $row['position']; ?></td>
                    </tr>
                </table>
                <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="popper.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script> 
</body>
</html>

