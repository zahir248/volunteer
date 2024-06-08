<?php
$userData = include_once '../controllers/fetch_user_data_dashboard_organizer.php'; // Include the PHP file and fetch the user data array
$fullname = $userData['fullname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer | Dashboard</title>
    <link rel="stylesheet" href="../styles/organizer_dashboard.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="content">
        <h1>Welcome Organizer, <?php echo $fullname; ?></h1>
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <a href="manage_events.php">Manage Events</a>
            <a href="view_volunteers.php">View Volunteers</a>
            <a href="messages.php">View Messages</a>
            <a href="profile.php">View Profile</a>
            <a href="#" class="logout" onclick="logout()">Logout</a>
        </div>
    </div>

    <script>
    function logout() {
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = '../controllers/logout.php';
        }
    }
    </script>
</body>
</html>
