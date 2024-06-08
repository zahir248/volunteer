<?php
require_once '../session/session.php';
require_once '../models/config.php';

// Ensure the user is logged in
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];
$userData = getUserData($user_id);

return $userData; // Return the fetched user data array
?>
