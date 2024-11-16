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

// Get the pre-order ID from POST request
$pre_order_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

// Check if ID is valid
if ($pre_order_id > 0) {
    $delete_sql = "DELETE FROM pre_orders WHERE id = $pre_order_id";

    if ($conn->query($delete_sql) === TRUE) {
        // Redirect after deletion
        header("Location: coworker_dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID";
}

$conn->close();
?>
