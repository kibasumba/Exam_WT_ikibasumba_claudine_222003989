<?php
// Database connection parameters
$host = "localhost"; // Change this to your database host
$dbname = "bike_shop_system"; // Change this to your database name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password

// Establish a database connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $membershipType = $_POST['membership'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into database
    $sql = "INSERT INTO Users (FirstName, LastName, Email, Phone, Address, MembershipType, PasswordHash) 
            VALUES (:firstname, :lastname, :email, :phone, :address, :membership, :password)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bindParam(':firstname', $firstName);
    $stmt->bindParam(':lastname', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':membership', $membershipType);
    $stmt->bindParam(':password', $hashedPassword);

    try {
        $stmt->execute();
        echo "User registered successfully!";
    } catch (PDOException $e) {
        echo "Registration failed. Error: " . $e->getMessage();
    }
}
?>
