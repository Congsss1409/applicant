<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'applicant');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM applications WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<link rel='stylesheet' href='bootstrap.min.css'>";
        echo "<script src='sweetalert2.all.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Record deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                    });
                });
            </script>"; // Closing parenthesis added here
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
