<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bike_shop_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if(password_verify($password, $row['PasswordHash'])) {
            // Password is correct, redirect to home page or do any other action
            header("Location: home.html");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid email or password'); window.location.href = 'login.html';</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found'); window.location.href = 'login.html';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
