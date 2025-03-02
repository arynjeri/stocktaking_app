<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Taking App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="resource.php">Resource</a>
        <a href="contact.php">Contact Us</a>
        <?php if ($loggedIn) : ?>
            <a href="profile.php">User Profile</a>
            <a href="help.php">Help</a>
            <a href="logout.php">Logout</a>
        <?php else : ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="help.php">Help</a>
        <?php endif; ?>
    </nav>

    <h1>Welcome</h1>

    <?php if ($loggedIn) : ?>
        <p>You are logged in.</p>
    <?php else : ?>
        <p>Please log in or register to access resources.</p>
    <?php endif; ?>

</body>
</html>
