<?php
// Database connection settings
$servername = "localhost";  // Your MySQL server (usually localhost)
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "sem_3";          // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
