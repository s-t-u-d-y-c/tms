<?php
// Include the database connection
include('db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $passwrd = $_POST['passwrd'];

    // Sanitize inputs to prevent SQL injection
    $fname = $conn->real_escape_string($fname);
    $lname = $conn->real_escape_string($lname);
    $email = $conn->real_escape_string($email);
    $passwrd = $conn->real_escape_string($passwrd);

    // Hash the password (important for security)
    $hashed_passwrd = password_hash($passwrd, PASSWORD_DEFAULT);

    // SQL query to insert the new user into the database
    $sql = "INSERT INTO users (fname, lname, email, passwrd) VALUES ('$fname', '$lname', '$email', '$hashed_passwrd')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML form for user registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form method="POST" action="">
        <label for="fname">First Name:</label><br>
        <input type="text" id="fname" name="fname" required><br><br>

        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="passwrd">Password:</label><br>
        <input type="password" id="passwrd" name="passwrd" required><br><br>

        <input type="submit" value="Register">
    </form>

    <!-- Login Link -->
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
    