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
        echo "<td><a href='view_application.php?id=" . $row['id'] . "' class='btn btn-info'>View</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No applications found</td></tr>";
}

mysqli_close($conn);
?>
