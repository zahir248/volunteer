<?php
require_once '../models/config.php';

function getJoinedEvents($user_id)
{
    $events = [];

    // Create connection
    $conn = db_connect();

    // Fetch joined events for the volunteer
    $sql = "SELECT e.event_id, e.title, e.description, e.start_date, e.end_date, e.location, e.event_category
            FROM event e
            INNER JOIN user_volunteer_event uve ON e.event_id = uve.event_id
            WHERE uve.user_id = ?
            ORDER BY e.start_date DESC"; // Order events by start date, latest first
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $events;
}
?>
