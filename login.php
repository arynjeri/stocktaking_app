<?php
session_start();
include 'db_connection.php';

// Handle login form submission
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials against the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php"); // Redirect to homepage
            exit;
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "User not found.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="login_container">
        <h1>Login</h1>
        <?php if (isset($login_error)) : ?>
            <p><?php echo $login_error; ?></p>
        <?php endif; ?>
        <form method="post" action="login.php" id="login_form">
            <div class="row">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="row">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="button">
                <input type="submit" value="Login">
            </div>
        </form>
        <p class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </p>
    </div>
</body>
</html>