<?php
// Start the session to check login status
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
    // If logged in, display the user's email
    $user_email = $_SESSION['user_email'];
    echo "<h2>Welcome, $user_email!</h2>";
    echo "<p>You are logged in.</p>";
    echo "<a href='logout.php'>Logout</a>";  // Link to log out the user
} else {
    // If not logged in, prompt the user to log in
    echo "<h2>You are not logged in.</h2>";
    echo "<p>Please <a href='login.php'>login</a> to continue.</p>";
    echo "<p>Please <a href='register.php'>register</a> to continue.</p>";
}
?>
