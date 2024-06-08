<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Volunteer</title>
    <link rel="stylesheet" href="../styles/signin.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="signin-container">
        <button class="back-button" onclick="window.location.href='../views/index.php';">
            <i>&#8592;</i> <!-- Left arrow symbol -->
        </button>
        <h2>Volunteer Match</h2>
        <form action="../controllers/process_signin.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div class="links">
            <a href="../views/forgot_password.php">Forgot password?</a>
            <a href="../views/register.php">New member?</a>
        </div>
    </div>
</body>
</html>
