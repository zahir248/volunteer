<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Get the logged-in user's ID and event ID from the URL
$user_id = $_SESSION['user_id'];
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if (!$event_id) {
    // Redirect if event ID is not provided
    header("Location: ../views/error.php");
    exit();
}

// Create connection
$conn = db_connect();

// Check connection
if ($conn === null) {
    // Handle connection error, maybe redirect to an error page
    die("Connection error: Unable to establish database connection.");
}

// Check if the user has already joined the event
$checkSql = "SELECT * FROM user_volunteer_event WHERE user_id = ? AND event_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ii", $user_id, $event_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    // If the user has already joined the event, redirect with a message
    echo "<script>alert('You have already joined this event!'); window.location.href='../views/upcoming_events.php';</script>";
    exit();
}

// Check if the event has available capacity
$capacitySql = "SELECT capacity FROM event WHERE event_id = ?";
$capacityStmt = $conn->prepare($capacitySql);
$capacityStmt->bind_param("i", $event_id);
$capacityStmt->execute();
$capacityResult = $capacityStmt->get_result();

if ($capacityResult->num_rows > 0) {
    $row = $capacityResult->fetch_assoc();
    $capacity = $row['capacity'];
    if ($capacity <= 0) {
        // If the capacity is 0 or less, redirect with a message
        echo "<script>alert('Sorry, this event is already full!'); window.location.href='../views/upcoming_events.php';</script>";
        exit();
    }
} else {
    // If the event ID is invalid or not found, redirect with an error message
    echo "<script>alert('Error: Event not found!'); window.location.href='../views/upcoming_events.php';</script>";
    exit();
}

// Insert data into user_volunteer_event table
$sql = "INSERT INTO user_volunteer_event (user_id, event_id, signup_date) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $user_id, $event_id);
    if ($stmt->execute()) {
        // Update the capacity in the event table
        $updateSql = "UPDATE event SET capacity = capacity - 1 WHERE event_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $event_id);
        $updateStmt->execute();
        
        // Success: Display alert message and redirect
        echo "<script>alert('You have successfully joined the event!'); window.location.href='../views/upcoming_events.php';</script>";
        exit();
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }
} else {
    // Error handling
    echo "Error: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
