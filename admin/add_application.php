<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Application</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        /* Custom CSS */
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: white;
        }
        .btn-back {
            margin-right: 10px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
    <script src='sweetalert2.all.min'></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="ATS Logo" height="50">
            </a>
            <h1 class="mx-auto">Applicant Tracking Management System</h1>
        </div>
    </nav>

    <!-- PHP code for form submission -->
    

    <!-- Form to add new application -->
    <div class="container">
        <h2 class="mb-4 mt-3">Add New Applicant</h2>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establish database connection
        $conn = mysqli_connect('localhost', 'root', '', 'applicant');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $position = $_POST['position'];

        // Check if the applicant already exists
        $sql_check = "SELECT * FROM applications WHERE email='$email'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Use SweetAlert for the error message
            echo "<script src='sweetalert2.all.min.js'></script>";
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Applicant with this email already exists',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // Redirect to the previous page after the alert is closed
                        window.history.back();
                    });
                 </script>";
        } else {
            // Insert the new applicant if they don't exist
            $sql_insert = "INSERT INTO applications (name, email, position) VALUES ('$name', '$email', '$position')";

            if (mysqli_query($conn, $sql_insert)) {
                // SweetAlert for success message
                echo "<script src='sweetalert2.all.min.js'></script>";
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Application added successfully',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // Redirect to the index page after the alert is closed
                            window.location.href = 'index.php';
                        });
                     </script>";
            } else {
                // SweetAlert for error message
                echo "<script src='sweetalert2.all.min.js'></script>";
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error occurred while adding application',
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) => {
                            // Redirect to the previous page after the alert is closed
                            window.history.back();
                        });
                     </script>";
            }
        }

        mysqli_close($conn);
    }
    ?>
        <form method="post">
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
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="index.php" class="btn btn-primary btn-back">Back to Dashboard</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="bootstrap.bundle.min.js"></script>
    <script src='sweetalert2.all.min.js'></script>
</body>
</html>
