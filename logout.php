<?php
session_start();

// Unset all active session 
session_unset();

// Clear and destroy the tracking token cookie structure on the server
session_destroy();

// Safely send the user back to the login page
header("Location: login.php");
exit();
?>