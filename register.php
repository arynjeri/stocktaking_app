<?php
session_start();
include 'db_connection.php';
// ... (Your login logic) ...

$hashed_password = null; // Initialize the variable here
$registration_error = "";
if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $user_id;
    // Clear any registration flags or session variables
    unset($_SESSION['registration_success']); // Example
    header("Location: resource.php");
    exit;
}

// Handle registration form submission
if (isset($_POST['register_username']) && isset($_POST['register_password']) && isset($_POST['confirm_password'])) {
    $register_username = $_POST['register_username'];
    $register_password = $_POST['register_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($register_password !== $confirm_password) {
        $registration_error = "Passwords do not match.";
    } else {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $register_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $registration_error = "Username already exists. Please <a href='login.php'>log in</a>.";
        } else {
            // Hash the password
            $hashed_password = password_hash($register_password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $register_username, $hashed_password);

            if ($stmt->execute()) {
                // Redirect to login after successful registration
                header("Location: login.php");
                exit;
            } else {
                $registration_error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (!empty($registration_error)) : ?>
        <p><?php echo $registration_error; ?></p>
    <?php endif; ?>
    <form method="post" action="register.php">
        <label for="register_username">Username:</label>
        <input type="text" name="register_username" id="register_username" required><br><br>

        <label for="register_password">Password:</label>
        <input type="password" name="register_password" id="register_password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>