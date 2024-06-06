<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];

// Create connection
$conn = db_connect();

// Fetch joined events for the volunteer
$sql = "SELECT e.event_id, e.title, e.description, e.start_date, e.end_date, e.location, e.event_category
        FROM event e
        INNER JOIN user_volunteer_event uve ON e.event_id = uve.event_id
        WHERE uve.user_id = ?
        ORDER BY e.start_date DESC"; // Order events by start date, latest first
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
    <title>Joined Events</title>
    <style>
        /* Integrated CSS styles */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('../images/joinedevents.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            position: relative; /* Added */
        }

        .back-button {
            position: absolute; /* Added */
            top: 20px; /* Added */
            left: 20px; /* Added */
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            background-color: #007BFF;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .event-container {
            background-color: rgba(0, 0, 0, 0.7); /* Adjusted opacity */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Added box shadow */
            overflow-x: auto; /* Added horizontal scroll */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .styled-table {
    width: 100%;
    border-collapse: collapse;
}

.styled-table th, .styled-table td {
    padding: 10px; /* Adjusted padding */
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}

.styled-table th {
    background-color: #007BFF; /* Header background color */
    color: white; /* Header text color */
}

.styled-table tbody tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.1);
}

.styled-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.2);
}


        p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <a class="back-button" href="../views/dashboard.php">&#8592; Back</a>
    <div class="event-container">
        <h1>Joined Events</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='styled-table'>";
            echo "<tr><th>No.</th><th>Title</th><th>Description</th><th>Start Date</th><th>End Date</th><th>Location</th><th>Event Category</th></tr>";
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['start_date']}</td>";
                echo "<td>{$row['end_date']}</td>";
                echo "<td>{$row['location']}</td>";
                echo "<td>{$row['event_category']}</td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        } else {
            echo "<p>No events joined yet.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
