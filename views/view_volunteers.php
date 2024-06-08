<?php
$events = include_once '../controllers/fetch_volunteers.php'; // Include the PHP file and fetch the events array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Volunteers</title>
    <link rel="stylesheet" href="../styles/view_volunteers.css"> <!-- Link to the CSS file -->
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
