<?php
// Include necessary files
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Check if event ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect if ID is not provided
    header("Location: ../views/manage_events.php");
    exit();
}

// Get the event ID from the URL
$event_id = $_GET['id'];

// Create connection
$conn = db_connect();

// Prepare a SQL statement to delete the event
$sql = "DELETE FROM event WHERE event_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);

// Execute the statement
if ($stmt->execute()) {
    // If deletion is successful, redirect back to the manage events page
    header("Location: ../views/manage_events.php");
} else {
    // If deletion fails, display an error message
    echo "Error deleting event: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
