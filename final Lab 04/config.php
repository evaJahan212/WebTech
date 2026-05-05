<?php
$host = "localhost";   // database server
$user = "root";        // database username
$pass = "";            // database password
$dbname = "student_management"; // database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
