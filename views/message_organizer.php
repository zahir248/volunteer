<?php
require_once '../controllers/message_organizer_logic.php'; // Include the PHP file

// Get the event ID and user ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if (!$event_id || !$user_id) {
    header("Location: ../views/error.php");
    exit();
}

$messages = getMessageData($event_id, $user_id); // Call the function to get the messages data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat | Volunteer</title>
    <link rel="stylesheet" href="../styles/message_organizer.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="back-button" href="../views/upcoming_events.php">&#8592; Back to Events</a>
            <span class="title">Community Chat</span>
        </div>
        <div class="messages">
            <?php
                if (!empty($messages)) {
                    foreach ($messages as $message) {
                        echo "<div class='message'>
                                <strong>{$message['sender_username']}</strong>: {$message['message_content']}
                                <div class='timestamp'>{$message['timestamp']}</div>
                              </div>";
                    }
                } else {
                    echo "<p>No messages yet.</p>";
                }
            ?>
        </div>
        <form class="message-form" method="post">
            <textarea name="message_content" placeholder="Write your message here..." required></textarea>
            <button class="send-button" type="submit">Send</button>
        </form>
    </div>
</body>
</html>
