<?php
// Include the database connection
include('db.php');

// Start the session to manage user state (e.g., login status)
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $email = $_POST['email'];
    $passwrd = $_POST['passwrd'];

    // Sanitize inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $passwrd = $conn->real_escape_string($passwrd);

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password with the hashed password stored in the database
        if (password_verify($passwrd, $user['passwrd'])) {
            // If password matches, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fname'] . ' ' . $user['lname'];
            $_SESSION['user_email'] = $user['email'];
            
            // Redirect to a index or home page (example: index.php)
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No user found with that email address!";
    }
}

// Close the connection
$conn->close();
?>

<!-- HTML Form for Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    
    <?php
    // Display any error messages if they exist
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>

    <form method="POST" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="passwrd">Password:</label><br>
        <input type="password" id="passwrd" name="passwrd" required><br><br>

        <input type="submit" value="Login">
    </form>
    
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
