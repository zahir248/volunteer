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

// Fetch upcoming events from the database for the logged-in user
$currentDate = date('Y-m-d'); // Get the current date
$sql = "SELECT e.event_id, e.title, e.description, e.location, e.start_date, e.end_date, e.capacity, e.event_category, e.creation_date, u.organization_name 
        FROM event e 
        INNER JOIN user u ON e.user_id = u.user_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <style>
        /* Add your CSS styles here */
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
        
        .back-button {
            background-color: #007BFF; /* Blue */
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff; /* Text color for better readability */
        }

        .join-button {
            background-color: #28a745; /* Green */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .join-button:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>
    <div class="top-bar">
        <a class="back-button" href="../views/dashboard.php">&#8592; Back</a>
    </div>
    <h2>Upcoming Events</h2>
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
                <th>Organization Name</th>
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
                                <td>{$row['organization_name']}</td>
                                <td><button class='join-button' onclick='confirmJoin({$row['event_id']})'>Join</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No events found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    
    <script>
        function confirmJoin(eventId) {
    if (confirm("Are you sure you want to join this event?")) {
        window.location.href = "../controllers/join_event.php?event_id=" + eventId;
    }
}

    </script>
</body>
</html>

<?php
$conn->close();
?>