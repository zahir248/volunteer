<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/signin.php");
    exit();
}

// Get the logged-in user's ID and event ID from the URL
$user_id = $_SESSION['user_id'];
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if (!$event_id) {
    header("Location: ../views/error.php");
    exit();
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
    die("Organizer not found.");
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

// Fetch messages between the user and the organizer for the specific event
// Fetch messages related to the event_id
$sql = "SELECT m.message_content, m.timestamp, u.username AS sender_username 
        FROM message m
        JOIN user u ON m.sender_id = u.user_id
        WHERE m.event_id = ?
        ORDER BY m.timestamp";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat | Volunteer</title>
    <style>
body {
            font-family: 'Arial', sans-serif;
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
            margin: 40px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 85vh; /* Adjust height as needed */
        }

        .header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .back-button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .header .back-button:hover {
            background-color: #0056b3;
        }

        .header .title {
            flex-grow: 1;
            text-align: center;
            font-size: 1.5em;
            margin-right: 30px; /* Adjust to balance with the back button width */
        }

        .messages {
            padding: 20px;
            flex: 2; /* Increased flex value for more space */
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
        }

        .message {
            background-color: #f9f9f9;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .message .timestamp {
            font-size: 0.8em;
            color: #666;
            text-align: right;
        }

        .message-form {
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .message-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .send-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 1em;
        }

        .send-button:hover {
            background-color: #218838;
        }    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="back-button" href="../views/upcoming_events.php">&#8592; Back to Events</a>
            <span class="title">Community Chat</span>
        </div>
        <div class="messages">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='message'>
                                <strong>{$row['sender_username']}</strong>: {$row['message_content']}
                                <div class='timestamp'>{$row['timestamp']}</div>
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

<?php
$stmt->close();
$conn->close();
?>
