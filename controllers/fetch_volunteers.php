<?php
require_once '../session/session.php';
require_once '../models/config.php';
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];

// Create connection
$conn = db_connect();

// Fetch events and their volunteers for the organizer's events
$sql = "SELECT e.event_id, e.title AS event_title, u.user_id, u.fullname, u.email, u.phone_number, u.state, u.country, u.interest
        FROM event e
        LEFT JOIN user_volunteer_event ev ON e.event_id = ev.event_id
        LEFT JOIN user u ON ev.user_id = u.user_id
        WHERE e.user_id = ?
        ORDER BY e.event_id, u.fullname";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $event_id = $row['event_id'];
    if (!isset($events[$event_id])) {
        $events[$event_id] = [
            'event_title' => $row['event_title'],
            'volunteers' => []
        ];
    }
    if ($row['user_id']) {
        $events[$event_id]['volunteers'][] = [
            'fullname' => $row['fullname'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'state' => $row['state'],
            'country' => $row['country'],
            'interest' => $row['interest']
        ];
    }
}

$stmt->close();
$conn->close();

return $events; // Return the fetched events array
?>
