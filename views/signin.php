<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Volunteer</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('/volunteer/images/signin.jpg'); /* Background image */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .signin-container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            position: relative;
        }

        .signin-container h2 {
            text-align: center;
            margin-bottom: 24px;
        }

        .signin-container input[type="email"],
        .signin-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .signin-container button[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .signin-container button[type="submit"]:hover {
            background-color: #45a049;
        }

        .signin-container .links {
            text-align: center;
            margin-top: 20px;
        }

        .signin-container .links a {
            color: #4CAF50;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }

        .signin-container .links a:hover {
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
        }

        .back-button i {
            color: #333;
        }

        .back-button:hover i {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <button class="back-button" onclick="window.history.back();">
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
