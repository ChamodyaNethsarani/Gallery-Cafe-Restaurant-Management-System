<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "galeryCafe");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate and sanitize input
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : null;
    $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : null;
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : null;
    $booking_date = isset($_POST['booking_date']) ? $conn->real_escape_string($_POST['booking_date']) : null;
    $number_of_guests = isset($_POST['number_of_guests']) ? intval($_POST['number_of_guests']) : null;
    $special_requests = isset($_POST['special_requests']) ? $conn->real_escape_string($_POST['special_requests']) : null;
    $table_id = isset($_POST['table_id']) ? intval($_POST['table_id']) : null;
    $parking_slot_count = isset($_POST['parking_slot_count']) ? intval($_POST['parking_slot_count']) : null;
    $start_time = isset($_POST['start_time']) ? $conn->real_escape_string($_POST['start_time']) : null;
    $end_time = isset($_POST['end_time']) ? $conn->real_escape_string($_POST['end_time']) : null;

    // Ensure required fields are provided
    if ($id && $name && $phone && $email && $booking_date && $number_of_guests && $table_id && $start_time && $end_time) {
        // Update query
        $sql = "UPDATE bookings SET 
                    name='$name', 
                    phone='$phone', 
                    email='$email', 
                    booking_date='$booking_date', 
                    number_of_guests='$number_of_guests', 
                    special_requests='$special_requests', 
                    table_id='$table_id', 
                    parking_slot_count='$parking_slot_count', 
                    start_time='$start_time', 
                    end_time='$end_time' 
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: coworker_dashboard.php"); // Redirect to the dashboard after update
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error: Missing required fields";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
