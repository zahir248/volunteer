<?php
$events = include_once '../controllers/fetch_upcoming_events.php'; // Include the PHP file and fetch the events array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <link rel="stylesheet" href="../styles/upcoming_events.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="top-bar">
        <a class="back-button" href="../views/dashboard.php">&#8592; Back</a>
    </div>
    <h2>Upcoming Events</h2>
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
                <th>Organization Name</th>
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
                                <td>{$event['organization_name']}</td>
                                <td>
                                    <div class='button-container'>
                                        <button class='join-button' onclick='confirmJoin({$event['event_id']})'>Join</button>
                                        <button class='message-button' onclick='sendMessage({$event['event_id']})'>Community</button>
                                    </div>
                                </td>
                              </tr>";
                        $eventNumber++;
                    }
                } else {
                    echo "<tr><td colspan='11'>No events found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    
    <script>
        function confirmJoin(eventId) {
            if (confirm("Are you sure you want to join this event?")) {
                window.location.href = "../controllers/join_event.php?event_id=" + eventId;
            }
        }

        function sendMessage(eventId) {
            window.location.href = "../views/message_organizer.php?event_id=" + eventId;
        }
    </script>
</body>
</html>
