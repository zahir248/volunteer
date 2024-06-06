<?php
require_once '../session/session.php';
require_once '../models/config.php';
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];

// Create connection
$conn = db_connect();

// Fetch events and their volunteers for the organizer's events
$sql = "SELECT e.event_id, e.title AS event_title, u.user_id, u.fullname, u.email, u.phone_number, u.state, u.country, u.interest
        FROM event e
        LEFT JOIN user_volunteer_event ev ON e.event_id = ev.event_id
        LEFT JOIN user u ON ev.user_id = u.user_id
        WHERE e.user_id = ?
        ORDER BY e.event_id, u.fullname";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $event_id = $row['event_id'];
    if (!isset($events[$event_id])) {
        $events[$event_id] = [
            'event_title' => $row['event_title'],
            'volunteers' => []
        ];
    }
    if ($row['user_id']) {
        $events[$event_id]['volunteers'][] = [
            'fullname' => $row['fullname'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'state' => $row['state'],
            'country' => $row['country'],
            'interest' => $row['interest']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Volunteers</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('../images/viewvolunteer.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #333;
            min-height: 100vh;
            margin: 20px;
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
            background-color: rgba(255, 255, 255, 0.9);
            margin-top: 20px;
            text-align: center; /* Center align table content */
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: center; /* Center align table content */
        }

        th {
            background-color: #d3d3d3;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 20px;
            background-color: #007BFF;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        caption {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            text-align: center; /* Center align caption */
            font-size: 1.2em;
            font-weight: bold;
        }

        .volunteer-table {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a class="back-button" href="../views/organizer_dashboard.php">&#8592; Back</a>
    </div>
    <h2>Volunteers List</h2>
    <?php
    if (!empty($events)) {
        foreach ($events as $event) {
            echo "<div class='volunteer-table'>
                    <table>
                        <caption>{$event['event_title']}</caption>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Interest</th>
                            </tr>
                        </thead>
                        <tbody>";
            if (!empty($event['volunteers'])) {
                $no = 1;
                foreach ($event['volunteers'] as $volunteer) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$volunteer['fullname']}</td>
                            <td>{$volunteer['email']}</td>
                            <td>{$volunteer['phone_number']}</td>
                            <td>{$volunteer['state']}</td>
                            <td>{$volunteer['country']}</td>
                            <td>{$volunteer['interest']}</td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr>
                        <td colspan='7'>No volunteers for this event</td>
                      </tr>";
            }
            echo "      </tbody>
                      </table>
                  </div>";
        }
    } else {
        echo "<p>No events found</p>";
    }
    ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
