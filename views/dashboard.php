<?php
require_once '../controllers/dashboard_logic.php'; // Include the PHP file

// Ensure the user is logged in
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];
$fullname = getUserFullName($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Volunteer</title>
    <link rel="stylesheet" href="../styles/dashboard.css"> <!-- Link to the CSS file -->
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
