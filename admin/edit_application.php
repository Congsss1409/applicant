<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>
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
    
    
    <?php
    
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'applicant');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided and is numeric
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    // Check if the updated email already exists for another applicant
    $sql_check = "SELECT * FROM applications WHERE email='$email' AND id!= $id";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        ?>
        <script src='sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Another applicant with this email already exists!',
            });
        </script>
        <?php
    } else {
        // Update the applicant if no duplicate email is found
        $sql = "UPDATE applications SET name='$name', email='$email', position='$position' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            ?>
            <script src='sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Application updated successfully!',
                    timer: 2000
                }).then(function () {
                    window.location.href = "index.php";
                    
                });
            </script>
            <?php
            exit();
        } else {
            ?>
            <script src='sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error occurred while updating the application!',
                });
            </script>
            <?php
        }
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM applications WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        ?>
        <script src='sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Application not found!',
            }).then(function () {
                window.history.back();
            });
        </script>
        <?php
        exit();
    }
} else {
    ?>
    <script src='sweetalert2.all.min.js'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid application ID!',
        }).then(function () {
            window.history.back();
        });
    </script>
    <?php
    exit();
}

mysqli_close($conn);
?>
    <!-- Edit Application Form -->
    <div class="container mt-4">
        <div class="card p-4">
            <h1 class="mb-4">Edit Application</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?php echo $row['position']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Go to Dashboard</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
