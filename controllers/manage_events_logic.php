<?php
require_once '../models/config.php';

function getOrganizerEvents($user_id)
{
    $events = [];

    // Create connection
    $conn = db_connect();

    // Fetch events from the database for the logged-in user
    $sql = "SELECT event_id, title, description, location, start_date, end_date, capacity, event_category, creation_date FROM event WHERE user_id = ?";
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
