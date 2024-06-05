<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];
$userData = getUserData($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Volunteer</title>
    <style>
        body {
            background-image: url('../images/profileorga.jpg'); /* Add the path to your image */
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

        .profile-container {
            background-color: rgba(0, 0, 0, 0.5); /* Add a semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%; /* Adjust width to fit content */
            max-width: 600px; /* Max width for larger screens */
        }

        .profile-container h1 {
            margin-bottom: 20px;
        }

        .profile-container p {
            margin: 10px 0;
            text-align: left;
        }

        .profile-container a {
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            border: 0px solid white; /* Add border for better visibility */
            border-radius: 5px;
            display: inline-block;
        }

        .profile-container a[href="edit_profile_volunteer.php"] {
            background-color: #4CAF50; /* Green color for the Edit Profile link */
            color: white;
        }

        .profile-container a[href="edit_profile_volunteer.php"]:hover {
            background-color: #45a049;
        }

        .profile-container a[href="dashboard.php"] {
            background-color: #007BFF; /* Blue color for the Back to Dashboard link */
            color: white;
        }

        .profile-container a[href="dashboard.php"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Profile Information</h1>
        <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $userData['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
        <?php if ($userData['organization_name'] !== null): ?>
            <p><strong>Organization Name:</strong> <?php echo $userData['organization_name']; ?></p>
        <?php endif; ?>
        <?php if ($userData['organization_description'] !== null): ?>
            <p><strong>Organization Description:</strong> <?php echo $userData['organization_description']; ?></p>
        <?php endif; ?>
        <p><strong>Phone Number:</strong> <?php echo $userData['phone_number']; ?></p>
        <p><strong>Address:</strong> <?php echo $userData['address']; ?></p>
        <p><strong>City:</strong> <?php echo $userData['city']; ?></p>
        <p><strong>State:</strong> <?php echo $userData['state']; ?></p>
        <p><strong>Country:</strong> <?php echo $userData['country']; ?></p>
        <p><strong>Postal Code:</strong> <?php echo $userData['postal_code']; ?></p>
        <p><strong>Interest:</strong> <?php echo $userData['interest']; ?></p>

        <a href="dashboard.php">Back to Dashboard</a>
        <a href="edit_profile_volunteer.php">Edit Profile</a>
    </div>
</body>
</html>
