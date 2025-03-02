<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: index.php");
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resource Page</title>
</head>
<body>
    <h1>Welcome to the Resource Page!</h1>

    <p>This is a protected resource. Only logged-in users can access this page.</p>

    <a href="resource.php?logout">Logout</a>
</body>
</html>