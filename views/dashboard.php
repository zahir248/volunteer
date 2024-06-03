<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];
$userData = getUserData($user_id);
$fullname = $userData['fullname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-image: url('../images/dashboard.jpg'); /* Add the path to your image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Set the height to fill the viewport */
            margin: 0; /* Remove default margin */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white; /* Set text color to white for better contrast */
            font-family: Arial, sans-serif; /* Set font family */
        }

        .content {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5); /* Add a semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px; /* Add margin to create space between content and buttons */
        }

        .content h1 {
            margin-bottom: 50px;
        }

        .content a {
            color: white; /* Set link color to white */
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid white; /* Add border for better visibility */
            border-radius: 5px;
        }

        .content a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Change background color on hover */
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Welcome Volunteer, <?php echo $fullname; ?></h1>
        <div style="margin-top: 20px; margin-bottom: 20px;"> <!-- Add margin-top to create space -->
            <a href="upcoming_events.php">View Upcoming Events</a>
            <a href="messages.php">View Messages</a>
            <a href="profile.php">View Profile</a>
            <a href="#" onclick="logout()">Logout</a>
        </div>
    </div>

    <script>
    function logout() {
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = '../controllers/logout.php'; // Updated path to logout.php
        }
    }
    </script>
</body>
</html>
