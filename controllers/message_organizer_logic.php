<?php
require_once '../models/config.php';
require_once '../session/session.php';

function getMessageData($event_id, $user_id)
{
    $messages = [];

    // Ensure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        return $messages;
    }

    // Create connection
    $conn = db_connect();

    // Fetch the organizer's ID
    $sql = "SELECT user_id FROM event WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($organizer_id);
    $stmt->fetch();
    $stmt->close();

    if (!$organizer_id) {
        $conn->close();
        return $messages;
    }

    // Handle message form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message_content = $_POST['message_content'];
        $sender_id = $user_id;
        $receiver_id = $organizer_id;

        // Insert message with event_id
        $sql = "INSERT INTO message (message_content, sender_id, receiver_id, event_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siii", $message_content, $sender_id, $receiver_id, $event_id);
        if ($stmt->execute()) {
            echo "<script>alert('Message sent!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Fetch messages between the user and the organizer for the specific event and order them by timestamp in descending order
    $sql = "SELECT m.message_content, m.timestamp, u.username AS sender_username 
            FROM message m
            JOIN user u ON m.sender_id = u.user_id
            WHERE m.event_id = ?
            ORDER BY m.timestamp DESC"; // Order by timestamp in descending order
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = [
                'sender_username' => $row['sender_username'],
                'message_content' => $row['message_content'],
                'timestamp' => $row['timestamp']
            ];
        }
    }

    $stmt->close();
    $conn->close();

    return $messages;
}
?>
