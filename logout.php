<?php
session_start();

// Unset all active session global array parameters
session_unset();

// Clear and destroy the tracking token cookie structure on the server
session_destroy();

// Safely send the user back to the gatekeeper login layout
header("Location: login.php");
exit();
?>