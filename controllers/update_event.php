<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $capacity = $_POST['capacity'];
    $event_category = $_POST['event_category'];

    // Update event details in the database
    $conn = db_connect();
    $sql = "UPDATE event SET title=?, description=?, location=?, start_date=?, end_date=?, capacity=?, event_category=? WHERE event_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $title, $description, $location, $start_date, $end_date, $capacity, $event_category, $event_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Alert message
    echo "<script>alert('Event details updated successfully');</script>";

    // Redirect back to manage_events.php after a short delay
    echo "<script>
            setTimeout(function() {
                window.location.href = '../views/manage_events.php?success=true';
            }, 500); // 2000 milliseconds delay (2 seconds)
          </script>";
    exit();
} else {
    // If form is not submitted, redirect to edit_event.php
    header("Location: ../views/edit_event.php");
    exit();
}
?>
