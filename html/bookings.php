<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $booking_date = trim($_POST['booking_date']);
    $start_time = trim($_POST['start_time']);
    $end_time = trim($_POST['end_time']);
    $table_id = intval(trim($_POST['table_id']));
    $parking_slot_count = intval(trim($_POST['parking_slot_count']));
    $special_requests = trim($_POST['special_requests']);

    // Validate input (basic validation)
    if (empty($name) || empty($email) || empty($booking_date) || empty($start_time) || empty($end_time) || $table_id <= 0 || $parking_slot_count < 0) {
        $error_message = "All fields are required, and numbers must be positive.";
    } else {
        // Check if the table is available
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE table_id = ? AND booking_date = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))");
        $stmt->bind_param("isssss", $table_id, $booking_date, $end_time, $start_time, $start_time, $end_time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "The selected table is already booked for the chosen time slot.";
        } else {
            // Check available parking slots
            $stmt = $conn->prepare("SELECT SUM(parking_slot_count) AS total_parking FROM bookings WHERE booking_date = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))");
            $stmt->bind_param("sssss", $booking_date, $end_time, $start_time, $start_time, $end_time);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $available_parking = 10 - $row['total_parking'];

            if ($parking_slot_count > $available_parking) {
                $error_message = "Not enough parking slots available. Please adjust the number or choose a different time.";
            } else {
                // Insert the booking into the database
                $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, booking_date, start_time, end_time, table_id, parking_slot_count, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssis", $name, $email, $phone, $booking_date, $start_time, $end_time, $table_id, $parking_slot_count, $special_requests);

                if ($stmt->execute()) {
                    $success_message = "Booking successful!";
                    header("Location: menu.php");
                    exit();
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            }
        }

        $stmt->close();
    }
}

// Close connection
$conn->close();
?>
