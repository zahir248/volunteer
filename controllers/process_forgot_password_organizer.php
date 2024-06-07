<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file

// Create connection
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Email exists, store the email in the session and redirect to reset password form
        $_SESSION['reset_email'] = $email;
        header("Location: ../views/reset_password_organizer.php");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        // Display alert message if email does not exist
        echo "<script>alert('No account found with that email address.'); window.location.href='../views/forgot_password_organizer.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
