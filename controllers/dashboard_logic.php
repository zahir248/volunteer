<?php
require_once '../session/session.php'; // Include session handling
require_once '../models/config.php'; // Include the configuration file

function getUserFullName($user_id)
{
    $userData = getUserData($user_id);
    return $userData['fullname'];
}
?>
