<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'applicant');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the application ID from the request
$appId = $_GET['id'];

// Query to get application details
$sql = "SELECT * FROM applications WHERE id = $appId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Output the application details in HTML format
    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
    echo "<p><strong>Position:</strong> " . $row['position'] . "</p>";
    echo "<p><strong>Status:</strong> " . $row['status'] . "</p>";
    // Add more details if needed
} else {
    echo "Application not found";
}

mysqli_close($conn);
?>
