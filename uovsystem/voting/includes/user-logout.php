<?php
    // Start a new session or resume the existing session
    session_start();
    
    // Destroy the current session, clearing all session data
    session_destroy();
    
    // Redirect the user to the home page (index.php)
    header("location:../index.php");
?>
