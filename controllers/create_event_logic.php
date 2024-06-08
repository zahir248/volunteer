<?php
require_once '../session/session.php'; // Include session handling
require_once '../models/config.php'; // Include the configuration file

function createEvent($title, $description, $location, $start_date, $end_date, $capacity, $event_category) {
    // Ensure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    // Get the current date
    $creation_date = date("Y-m-d");

    // Insert the event into the database
    $conn = db_connect();
    $sql = "INSERT INTO event (user_id, title, description, location, start_date, end_date, capacity, event_category, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssiss", $_SESSION['user_id'], $title, $description, $location, $start_date, $end_date, $capacity, $event_category, $creation_date);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>
