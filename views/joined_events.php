<?php
require_once '../controllers/joined_events_logic.php'; // Include the PHP file
require_once '../session/session.php'; // Include session handling
require_once '../models/config.php'; // Include the configuration file

check_login(); // Ensure the user is logged in

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];

$events = getJoinedEvents($user_id); // Call the function to get the joined events data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joined Events</title>
    <link rel="stylesheet" href="../styles/joined_events.css"> <!-- Link to the CSS file -->
</head>
<body>
    <a class="back-button" href="../views/dashboard.php">&#8592; Back</a>
    <div class="event-container">
        <h1>Joined Events</h1>
        <?php
        if (!empty($events)) {
            echo "<table class='styled-table'>";
            echo "<tr><th>No.</th><th>Title</th><th>Description</th><th>Start Date</th><th>End Date</th><th>Location</th><th>Event Category</th></tr>";
            $no = 1;
            foreach ($events as $event) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$event['title']}</td>";
                echo "<td>{$event['description']}</td>";
                echo "<td>{$event['start_date']}</td>";
                echo "<td>{$event['end_date']}</td>";
                echo "<td>{$event['location']}</td>";
                echo "<td>{$event['event_category']}</td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        } else {
            echo "<p>No events joined yet.</p>";
        }
        ?>
    </div>
</body>
</html>
