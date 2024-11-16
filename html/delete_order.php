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

// Delete the order
$order_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$sql = "DELETE FROM orders WHERE id = $order_id";

if ($conn->query($sql) === TRUE) {
    header("Location: coworker_dashboard.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
