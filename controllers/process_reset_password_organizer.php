<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file

// Create connection
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_SESSION['reset_email'];

    // Update the password in the database
    $sql = "UPDATE user SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password, $email);
    
    if ($stmt->execute()) {
        // Display success message and redirect to sign-in page
        echo "<script>alert('Password reset successfully.'); window.location.href='../views/organizer_signin.php';</script>";
        unset($_SESSION['reset_email']);
    } else {
        // Display error message and redirect back to reset password page
        echo "<script>alert('Error resetting password.'); window.location.href='../views/reset_password_organizer.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
