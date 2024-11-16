<?php
session_start();

// Check if the user is logged in as a coworker
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'coworker') {
    header("Location: clogin.php");
    exit();
}

// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID from the POST request
$order_id = intval($_POST['id']);

// Update the status of the order
$sql = "UPDATE orders SET order_status = 'confirmed' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    echo "Order confirmed.";
} else {
    echo "Error confirming order: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
