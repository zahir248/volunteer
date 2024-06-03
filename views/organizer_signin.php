<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Sign In</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            background-image: url('/volunteer/images/organizersignin.jpg'); /* Background image */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Add this */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
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

        .container .links {
            text-align: center;
            margin-top: 20px;
        }

        .container .links a {
            color: #4CAF50;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }

        .container .links a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Volunteer Match</h2>
        <h3>Organizer</h3>
        <form action="../controllers/process_organizer_signin.php" method="POST">
            <button class="back-button" onclick="window.history.back();">
                <i>&#8592;</i> <!-- Left arrow symbol -->
            </button>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign In</button>
        </form>
        <div class="links">
            <a href="../views/forgot_password.php">Forgot password?</a>
            <a href="../views/register.php">New member?</a>
        </div>
    </div>
</body>
</html>
