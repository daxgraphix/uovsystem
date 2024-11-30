<?php

// Start a new session or resume the current session
session_start();

// Destroy the current session, clearing all session variables
session_destroy();

// Redirect the user to the admin login page (index.php)
header("location:../admin/index.php");

?>
