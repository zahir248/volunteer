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

// Fetch messages for the user and order them by timestamp in descending order
$sql = "SELECT m.message_id, m.message_content, m.timestamp, u.username AS sender_username, e.title
        FROM message m
        JOIN user u ON m.sender_id = u.user_id
        JOIN event e ON m.event_id = e.event_id
        WHERE m.receiver_id = ?
        ORDER BY m.timestamp DESC"; // Order by timestamp in descending order
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$messages_result = $stmt->get_result();

$messages = [];
if ($messages_result->num_rows > 0) {
    while ($row = $messages_result->fetch_assoc()) {
        $messages[] = [
            'sender_username' => $row['sender_username'],
            'title' => $row['title'],
            'message_content' => $row['message_content'],
            'timestamp' => $row['timestamp']
        ];
    }
}

return $messages; // Return the fetched messages array
?>
