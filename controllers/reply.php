<?php
// Include the configuration file
require_once '../models/config.php';
require_once '../session/session.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the reply content and selected event ID from the form
    $reply_content = $_POST["reply_content"];
    $event_id = $_POST["event_id"];

    // Get the logged-in user's ID
    $sender_id = $_SESSION['user_id'];

    // Set the receiver ID to 0
    $receiver_id = 0;

    // Create connection
    $conn = db_connect();

    // Prepare and execute the SQL statement to insert the reply into the database
    $sql = "INSERT INTO message (sender_id, receiver_id, message_content, event_id, timestamp)
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $sender_id, $receiver_id, $reply_content, $event_id);
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    // Display an alert message
    echo '<script>
            alert("Message sent successfully!");
            setTimeout(function() {
                window.location.href = "../views/messages.php";
            }, 200); // 200 milliseconds = 0.2 second
          </script>';
    exit();
} else {
    // If the form is not submitted, redirect to an appropriate page
    header("Location: ../views/error_page.php");
    exit();
}
?>
