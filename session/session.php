<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /volunteer/views/signin.php");
        exit();
    }
}
?>
