<?php
// Retrieve form data
$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$table_id = $_POST['table_id'];
$parking_slot_id = $_POST['parking_slot_id'];
$booking_start_time = $_POST['booking_start_time'];
$booking_end_time = $_POST['booking_end_time'];
$booking_date = $_POST['booking_date'];

// Connect to database
$conn = new mysqli("localhost", "username", "password", "restaurant");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert reservation into database
$sql = "INSERT INTO reservations (name, phone_number, contact_number, email, table_id, parking_slot_id, booking_start_time, booking_end_time, booking_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiiiss", $name, $phone_number, $contact_number, $email, $table_id, $parking_slot_id, $booking_start_time, $booking_end_time, $booking_date);

if ($stmt->execute()) {
    // Update table and parking slot status
    $conn->query("UPDATE tables SET is_booked = 1 WHERE id = $table_id");
    if ($parking_slot_id) {
        $conn->query("UPDATE parking_slots SET is_reserved = 1 WHERE id = $parking_slot_id");
    }
    echo "Reservation successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
