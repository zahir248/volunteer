<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Check if the form is submitted
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
    
    // Get the current date
    $creation_date = date("Y-m-d");

    // Insert the event into the database
    $conn = db_connect();
    $sql = "INSERT INTO event (user_id, title, description, location, start_date, end_date, capacity, event_category, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssiss", $_SESSION['user_id'], $title, $description, $location, $start_date, $end_date, $capacity, $event_category, $creation_date);
    if ($stmt->execute()) {
        // If insertion is successful, redirect to the manage events page
        header("Location: ../views/manage_events.php");
        exit();
    } else {
        // If insertion fails, display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../images/createevent.jpg'); /* Replace 'path/to/your/image.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the opacity as needed */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
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
            height: 100px;
        }

        input[type="submit"],
        .cancel-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .cancel-button {
            background-color: #f44336; /* Red */
        }

        .cancel-button:hover {
            background-color: #f44336;
        }

        input[type="submit"]:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
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
