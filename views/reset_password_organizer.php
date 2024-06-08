<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Organizer</title>
    <link rel="stylesheet" href="../styles/reset_password_organizer.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="reset-password-container">
        <button class="back-button" onclick="window.location.href='../views/forgot_password_organizer.php';">
            <i>&#8592;</i> <!-- Left arrow symbol -->
        </button>
        <h2>Reset Password</h2>
        <form action="../controllers/process_reset_password_organizer.php" method="POST">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Reset Password</button>
        </form>
        <div class="links">
            <a href="../views/organizer_signin.php">Back to Sign In</a>
        </div>
    </div>
</body>
</html>
