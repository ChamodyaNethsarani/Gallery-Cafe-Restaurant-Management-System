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

// Get the pre-order ID from the POST request
$pre_order_id = intval($_POST['id']);

// Update the status of the pre-order
$sql = "UPDATE pre_orders SET status = 'confirmed' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pre_order_id);

if ($stmt->execute()) {
    echo "Pre-order confirmed.";
} else {
    echo "Error confirming pre-order: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
