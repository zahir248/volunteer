<?php
$messages = include_once '../controllers/fetch_messages.php'; // Include the PHP file and fetch the messages array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat | Organizer</title>
    <link rel="stylesheet" href="../styles/messages.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <div class="messages">
            <?php
            if (!empty($messages)) {
                foreach ($messages as $message) {
                    ?>
                    <div class="message">
                        <strong><?php echo $message['sender_username']; ?></strong> (Event: <?php echo $message['title']; ?>): <?php echo $message['message_content']; ?>
                        <div class="timestamp"><?php echo $message['timestamp']; ?></div>
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
                <span>&#8592;</span> Back to Dashboard
            </button>
        </a>
    </div>
</body>
</html>
