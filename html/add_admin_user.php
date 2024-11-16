<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin credentials
$email = "admin@gmail.com";
$password = password_hash("admin", PASSWORD_DEFAULT); // Hash the password
$role = "admin";

// Insert the admin user
$stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sss", $email, $password, $role);

if ($stmt->execute()) {
    echo "Admin user added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
