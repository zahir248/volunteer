<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Volunteer</title>
    <link rel="stylesheet" href="../styles/forgot_password.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="forgot-password-container">
        <button class="back-button" onclick="window.location.href='../views/signin.php';">
            <i>&#8592;</i> <!-- Left arrow symbol -->
        </button>
        <h2>Reset Password</h2>
        <form action="../controllers/process_forgot_password.php" method="POST">
            <label for="email">Enter your email</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Verify Email</button>
        </form>
    </div>
</body>
</html>
