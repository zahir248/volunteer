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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database for the logged-in user
$sql = "SELECT event_id, title, description, location, start_date, end_date, capacity, event_category, creation_date FROM event WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('../images/manageevent.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #333; /* Text color for better readability */
            min-height: 100vh;
            margin: 20px; /* Add margin to the body */
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .new-event-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background for the table */
            margin-top: 20px; /* Add margin to the top of the table */
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #d3d3d3; /* Grey */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons button {
            margin: 0 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .back-button, .new-event-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 20px; /* Add margin to the right of the buttons */
        }

        .back-button {
            background-color: #007BFF; /* Blue */
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .new-event-button {
            background-color: #28a745; /* Green */
        }

        .new-event-button:hover {
            background-color: #218838;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff; /* Text color for better readability */
        }

        /* Style for edit button */
        .edit-button {
            background-color: #ffa500; /* Orange */
            color: white;
        }

        .edit-button:hover {
            background-color: #ff8c00; /* Darker shade of orange */
        }

        /* Style for delete button */
        .delete-button {
            background-color: #f44336; /* Red */
            color: white;
        }

        .delete-button:hover {
            background-color: #d32f2f; /* Darker shade of red */
        }
    </style>
</head>
<body>
    <div class="top-bar">
    <a class="back-button" href="../views/organizer_dashboard.php">&#8592; Back</a>
    </div>
    <div class="new-event-bar">
        <a class="new-event-button" href="create_event.php">+ New Event</a>
    </div>
    <h2>Manage Events</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Capacity</th>
                <th>Event Category</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['title']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['capacity']}</td>
                                <td>{$row['event_category']}</td>
                                <td>{$row['creation_date']}</td>
                                <td class='action-buttons'>
                                    <button class='edit-button' onclick=\"window.location.href='edit_event.php?id={$row['event_id']}'\">Edit</button>
                                    <button class='delete-button' onclick=\"confirmDelete({$row['event_id']})\">Delete</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No events found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <script>
        function confirmDelete(eventId) {
            if (confirm("Are you sure you want to delete this event?")) {
                window.location.href = "../controllers/delete_event.php?id=" + eventId;
            }
        }
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
