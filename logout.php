<?php
// Start the session
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect the user to the index page
header("Location: index.php");
exit();
?>
