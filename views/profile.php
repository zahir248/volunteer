<?php
$userData = include_once '../controllers/fetch_user_data.php'; // Include the PHP file and fetch the user data array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Organizer</title>
    <link rel="stylesheet" href="../styles/profile.css"> <!-- Link to the CSS file -->
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
