<?php
$hostname = "localhost"; 
$username = "stocktaking"; // Your database username
$password = "stocktaking"; // Your database password
$dbname = "stocktaking"; // Your database name

$conn = new mysqli($hostname, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>