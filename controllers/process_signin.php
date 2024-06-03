<?php
require_once '../model/config.php';
require_once '../session/session.php';

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
    if (password_verify($password, $hashed_password) && $user_type === 'volunteer') {
        // Password is correct and user type is volunteer, start a new session
        session_start();
        $_SESSION['user_id'] = $id;
        // Display success message
        echo '<script>alert("Login successful.");</script>';
        // Redirect to dashboard page
        header("Location: ../views/dashboard.php");
        exit();
    } else {
        // Password is incorrect or user type is not volunteer, display error message
        echo '<script>alert("Invalid credentials or not a volunteer.");</script>';
        include '../views/signin.php'; // Include sign-in page again
        exit();
    }
} else {
    // Email not found, display error message
    echo '<script>alert("No account found with that email.");</script>';
    include '../views/signin.php'; // Include sign-in page again
    exit();
}

$stmt->close();
$conn->close();
?>
