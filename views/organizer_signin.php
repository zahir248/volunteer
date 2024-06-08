<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Organizer</title>
    <link rel="stylesheet" href="../styles/organizer_signin.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h2>Volunteer Match</h2>
        <h3>Organizer</h3>
        <form action="../controllers/process_organizer_signin.php" method="POST">
            <button class="back-button" onclick="window.location.href='../views/index.php';">
                <i>&#8592;</i> <!-- Left arrow symbol -->
            </button>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    &#128065; <!-- Eye icon -->
                </span>
            </div>

            <button type="submit">Sign In</button>
        </form>
        <div class="links">
            <a href="../views/forgot_password_organizer.php">Forgot password?</a>
            <a href="../views/register.php">New member?</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordFieldType = passwordField.getAttribute("type");
            if (passwordFieldType === "password") {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        }
    </script>
</body>
</html>