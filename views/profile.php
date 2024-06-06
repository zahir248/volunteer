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
    <title>Profile | Organizer</title>
    <style>
        body {
            background-image: url('../images/profileorga.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            font-family: Arial, sans-serif;
        }

        .profile-container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        .profile-container h1 {
            margin-bottom: 20px;
        }

        .profile-container p {
            margin: 10px 0;
            text-align: left;
        }

        .profile-container a {
            color: var(--button-color, white);
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .profile-container a.edit {
            background-color: var(--edit-color, #28a745);
            border: 1px solid var(--edit-color, #28a745);
        }

        .profile-container a.dashboard {
            background-color: var(--dashboard-color, #007BFF);
            border: 1px solid var(--dashboard-color, #007BFF);
        }

        .profile-container a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .profile-container a.edit:hover {
            background-color: var(--edit-color-hover, #218838);
            border-color: var(--edit-color-hover, #218838);
        }

        .profile-container a.dashboard:hover {
            background-color: var(--dashboard-color-hover, #0056b3);
            border-color: var(--dashboard-color-hover, #0056b3);
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

        <a href="edit_profile.php" class="edit">Edit Profile</a>
        <a href="organizer_dashboard.php" class="dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
