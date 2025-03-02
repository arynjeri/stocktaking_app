<?php
session_start();
include 'db_connection.php';

$message = "";

if (isset($_POST['username_or_email'])) {
    $username_or_email = $_POST['username_or_email'];

    // Check if the username or email exists
    $stmt = $conn->prepare("SELECT id, email FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_email);
        $stmt->fetch();

        // Generate a unique reset token
        $reset_token = bin2hex(random_bytes(32));
        $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Store the token in the database
        $stmt = $conn->prepare("INSERT INTO password_reset_tokens (user_id, token, expiry) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $reset_token, $token_expiry);

        if ($stmt->execute()) {
            // Send the email
            $reset_link = "http://yourdomain.com/reset_password.php?token=" . $reset_token; // Replace with your domain

            $subject = "Password Reset Request";
            $body = "Please click the following link to reset your password: " . $reset_link;
            $headers = "From: noreply@yourdomain.com"; // Replace with your email

            if (mail($user_email, $subject, $body, $headers)) {
                $message = "A password reset link has been sent to your email address.";
            } else {
                $message = "Failed to send email. Please try again later.";
            }
        } else {
            $message = "Failed to generate reset token. Please try again.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <p>Enter your username or email address to reset your password.</p>

    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php else : ?>
        <form method="post" action="forgot_password.php">
            <label for="username_or_email">Username or Email:</label>
            <input type="text" name="username_or_email" id="username_or_email" required><br><br>
            <input type="submit" value="Reset Password">
        </form>
    <?php endif; ?>
</body>
</html>