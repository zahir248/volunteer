<?php
require_once '../controllers/manage_events_logic.php'; // Include the PHP file
require_once '../session/session.php';

// Get the logged-in user's ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    header("Location: ../views/error.php");
    exit();
}

$events = getOrganizerEvents($user_id); // Call the function to get the events data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="../styles/manage_events.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="top-bar">
        <a class="back-button" href="../views/organizer_dashboard.php">&#8592; Back</a>
    </div>
    <div class="new-event-bar">
        <a class="new-event-button" href="create_event.php">+ New Event</a>
    </div>
    <h2>Manage Events</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Capacity</th>
                <th>Event Category</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $eventNumber = 1;
            if (!empty($events)) {
                foreach ($events as $event) {
                    echo "<tr>
                            <td>{$eventNumber}</td>
                            <td>{$event['title']}</td>
                            <td>{$event['description']}</td>
                            <td>{$event['location']}</td>
                            <td>{$event['start_date']}</td>
                            <td>{$event['end_date']}</td>
                            <td>{$event['capacity']}</td>
                            <td>{$event['event_category']}</td>
                            <td>{$event['creation_date']}</td>
                            <td class='action-buttons'>
                                <button class='edit-button' onclick=\"window.location.href='edit_event.php?id={$event['event_id']}'\">Edit</button>
                                <button class='delete-button' onclick=\"confirmDelete({$event['event_id']})\">Delete</button>
                            </td>
                        </tr>";
                    $eventNumber++;
                }
            } else {
                echo "<tr><td colspan='10'>No events found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function confirmDelete(eventId) {
            if (confirm("Are you sure you want to delete this event?")) {
                window.location.href = "../controllers/delete_event.php?id=" + eventId;
            }
        }
    </script>
</body>
</html>
