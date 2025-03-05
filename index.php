<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Stock Taking App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body id="index">


    <nav class="navbar">
        <div class="logo">Stock App</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="resource.php">Resource</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="profile.php">User Profile</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="help.php">Help</a></li>
            <?php endif; ?>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome</h1>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <p class="logged-in">You are logged in.</p>
        <?php else : ?>
            <p class="logged-out">Please log in or register to access resources.</p>
        <?php endif; ?>
        </div>
   
<script src="script.js"></script>     
</body>
</html>
