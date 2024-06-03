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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../images/updateevent.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for better readability */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333; /* Text color for better readability */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333; /* Text color for better readability */
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .cancel-button {
    display: block; /* Change display to block to center the text */
    width: fit-content; /* Make the button width fit the content */
    margin: 0 auto; /* Center the button horizontally */
    padding: 10px 20px;
    background-color: #ff0000; /* Red background color */
    color: #fff; /* White text color */
    text-decoration: none;
    border-radius: 4px;
    margin-top: 10px;
    text-align: center; /* Center the text */
}

.cancel-button:hover {
    background-color: #cc0000; /* Darker red on hover */
}

    </style>
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
