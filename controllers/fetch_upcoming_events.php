<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Create connection
$conn = db_connect();

// Fetch upcoming events from the database for the logged-in user
$currentDate = date('Y-m-d'); // Get the current date
$sql = "SELECT e.event_id, e.title, e.description, e.location, e.start_date, e.end_date, e.capacity, e.event_category, e.creation_date, u.organization_name 
        FROM event e 
        INNER JOIN user u ON e.user_id = u.user_id";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();

return $events; // Return the fetched events array
?>
