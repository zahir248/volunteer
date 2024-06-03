<?php
require_once '../models/config.php';
require_once '../session/session.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create connection
    $conn = db_connect();

    // Prepare and bind
    $stmt = $conn->prepare("SELECT user_id, password, user_type FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $user_type);
        $stmt->fetch();

        // Verify password and user type
        if (password_verify($password, $hashed_password) && $user_type === 'organizer') {
            // Password is correct and user type is organizer, start a new session
            session_start();
            $_SESSION['user_id'] = $id;
            // Redirect to organizer dashboard
            header("Location: ../views/organizer_dashboard.php");
            exit();
        } else {
            // Password is incorrect or user type is not organizer, display error message
            echo '<script>alert("Invalid credentials or not an organizer.");</script>';
            include '../views/organizer_signin.php'; // Include sign-in page again
            exit();
        }
    } else {
        // Email not found, display error message
        echo '<script>alert("No account found with that email.");</script>';
        include '../views/organizer_signin.php'; // Include sign-in page again
        exit();
    }

    $stmt->close();
    $conn->close();
} 
?>
