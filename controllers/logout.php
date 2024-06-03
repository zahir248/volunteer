<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views/index.php"); // Adjusted path to index.php in the views directory
exit();
?>
