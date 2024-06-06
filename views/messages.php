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

// Fetch messages for the user
$sql = "SELECT m.message_id, m.message_content, m.timestamp, u.username AS sender_username, e.title
        FROM message m
        JOIN user u ON m.sender_id = u.user_id
        JOIN event e ON m.event_id = e.event_id
        WHERE m.receiver_id = ?
        ORDER BY m.timestamp";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$messages_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat | Organizer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('../images/messagevolunteer.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white background */
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .message strong {
            color: #007bff;
        }

        .message .timestamp {
            font-size: 0.8em;
            color: #666;
        }

        .no-messages {
            color: #999;
            font-style: italic;
        }

        .reply-form {
            margin-top: 10px;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 6px;
        }

        .reply-form textarea {
            width: calc(100% - 20px);
            height: 60px;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .reply-form button {
            margin-top: 5px;
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="messages">
            <?php
            if ($messages_result->num_rows > 0) {
                while ($row = $messages_result->fetch_assoc()) {
                    ?>
                    <div class="message">
                        <strong><?php echo $row['sender_username']; ?></strong> (Event: <?php echo $row['title']; ?>): <?php echo $row['message_content']; ?>
                        <div class="timestamp"><?php echo $row['timestamp']; ?></div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='no-messages'>No messages yet.</p>";
            }
            ?>
        </div>
        <!-- Reply form -->
        <div class="reply-form">
            <form action="../controllers/reply.php" method="post">
                <textarea name="reply_content" placeholder="Type your reply here..." required></textarea>

                <!-- Dropdown menu for selecting the event -->
        <label for="event">Select Event:</label>
        <select name="event_id" id="event">
            <?php
            // Fetch events from the database
            $event_sql = "SELECT event_id, title FROM event WHERE user_id = ?";
            $event_stmt = $conn->prepare($event_sql);
            $event_stmt->bind_param("i", $user_id);
            $event_stmt->execute();
            $event_result = $event_stmt->get_result();

            // Display each event as an option in the dropdown menu
            while ($event_row = $event_result->fetch_assoc()) {
                echo "<option value='" . $event_row['event_id'] . "'>" . $event_row['title'] . "</option>";
            }

            $event_stmt->close();
            ?>
        </select>
                <button type="submit">Reply</button>
            </form>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../views/organizer_dashboard.php" style="text-decoration: none; color: #007bff;">
            <button style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                <span>&#8592;</span> Back to Organizer Dashboard
            </button>
        </a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
