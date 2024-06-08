<?php
require_once '../controllers/create_event_logic.php'; // Include the PHP file

// Initialize a variable to hold the success message
$success_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $capacity = $_POST['capacity'];
    $event_category = $_POST['event_category'];
    
    // Call the function to create event
    if (createEvent($title, $description, $location, $start_date, $end_date, $capacity, $event_category)) {
        // Set the success message
        $success_message = "Event created successfully!";
        // Execute JavaScript code to display the success message in an alert and then redirect
        echo "<script>alert('$success_message'); window.location.href = '../views/manage_events.php';</script>";
        exit(); // Stop executing PHP code
    } else {
        // If creation fails, display an error message
        echo "Error creating event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="../styles/create_event.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h2>Create New Event</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br>
            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location" required><br>
            <label for="start_date">Start Date:</label><br>
            <input type="date" id="start_date" name="start_date" required><br>
            <label for="end_date">End Date:</label><br>
            <input type="date" id="end_date" name="end_date" required><br>
            <label for="capacity">Capacity:</label><br>
            <input type="number" id="capacity" name="capacity" required><br>
            <label for="event_category">Event Category:</label><br>
            <input type="text" id="event_category" name="event_category" required><br><br>
            <input type="submit" value="Submit">
            <a href="javascript:history.go(-1)" class="cancel-button">Cancel</a>
        </form>
    </div>
</body>
</html>
