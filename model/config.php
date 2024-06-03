<?php
// Database connection variables
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'volunteer');

// Create connection
function db_connect() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function getUserData($user_id) {
    // Create connection
    $conn = db_connect();

    // Fetch user data
    $stmt = $conn->prepare("SELECT fullname, email FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($fullname, $email);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    // Return user data as an array
    return [
        'fullname' => $fullname,
        'email' => $email
    ];
}
?>
