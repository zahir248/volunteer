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
    <title>Dashboard | Volunteer</title>
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
            color: white; /* Set text color to white */
            background-color: #007BFF; /* Set background color to blue */
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid #007BFF; /* Set border color to blue */
            border-radius: 5px;
        }

        .content a:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
        }

       /* Style for logout button */
       .content a.logout {
            background-color: #dc3545; /* Set background color to red */
            border-color: #dc3545; /* Set border color to red */
        }

        .content a.logout:hover {
            background-color: #c82333; /* Darker shade of red on hover */
        }

        
    </style>
</head>
<body>
    <div class="content">
        <h1>Welcome Volunteer, <?php echo $fullname; ?></h1>
        <div style="margin-top: 20px; margin-bottom: 20px;"> <!-- Add margin-top to create space -->
            <a href="upcoming_events.php">View Upcoming Events</a>
            <a href="joined_events.php">View Joined Events</a> <!-- New button for joined events -->
            <a href="profile_volunteer.php">View Profile</a>
            <a href="#" onclick="logout()" class="logout">Logout</a>
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
