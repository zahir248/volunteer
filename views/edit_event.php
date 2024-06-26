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

// Check if event ID is provided via GET parameter
if (!isset($_GET['id'])) {
    header("Location: ../views/organizer_dashboard.php");
    exit();
}

$event_id = $_GET['id'];

// Create connection
$conn = db_connect();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details from the database
$sql = "SELECT title, description, location, start_date, end_date, capacity, event_category FROM event WHERE event_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $event_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Event not found or user doesn't have permission to edit
    header("Location: ../views/organizer_dashboard.php");
    exit();
}

$row = $result->fetch_assoc();
$title = $row['title'];
$description = $row['description'];
$location = $row['location'];
$start_date = $row['start_date'];
$end_date = $row['end_date'];
$capacity = $row['capacity'];
$event_category = $row['event_category'];

// Close statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="../styles/edit_event.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Event</h1>
        <form action="../controllers/update_event.php" method="post">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>">
            
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $description; ?></textarea>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $location; ?>">
            
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
            
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
            
            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo $capacity; ?>">
            
            <label for="event_category">Event Category:</label>
            <input type="text" id="event_category" name="event_category" value="<?php echo $event_category; ?>">
            
            <input type="submit" value="Update Event">
            <!-- Cancel button -->
            <a href="../views/manage_events.php" class="cancel-button">Cancel</a>
        </form>
    </div>
</body>
</html>
