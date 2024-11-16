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

// Fetch the booking details if an ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();

    if (!$booking) {
        die("Booking not found.");
    }
} else {
    die("No booking ID provided.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $booking_date = $_POST['booking_date'] ?? '';
    $number_of_guests = (int)($_POST['number_of_guests'] ?? 0);
    $special_requests = $_POST['special_requests'] ?? '';
    $table_id = (int)($_POST['table_id'] ?? 0);
    $parking_slot_count = (int)($_POST['parking_slot_count'] ?? 0);
    $start_time = $_POST['start_time'] ?? '';
    $end_time = $_POST['end_time'] ?? '';

    $sql = "UPDATE reservations SET
        name=?, email=?, phone=?, booking_date=?, number_of_guests=?, 
        special_requests=?, table_id=?, parking_slot_count=?, start_time=?, end_time=?
        WHERE id=?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param('sssssiiissi', 
        $name, 
        $email, 
        $phone, 
        $booking_date, 
        $number_of_guests, 
        $special_requests, 
        $table_id, 
        $parking_slot_count, 
        $start_time, 
        $end_time,
        $id
    );

    if ($stmt->execute()) {
        header("Location: coworker_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Booking</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($booking['id']); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($booking['phone']); ?>" required>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>
        </div>

        <div class="form-group">
            <label for="number_of_guests">Number of Guests:</label>
            <input type="number" id="number_of_guests" name="number_of_guests" value="<?php echo htmlspecialchars($booking['number_of_guests']); ?>" required>
        </div>

        <div class="form-group">
            <label for="special_requests">Special Requests:</label>
            <textarea id="special_requests" name="special_requests"><?php echo htmlspecialchars($booking['special_requests']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="table_id">Table ID:</label>
            <input type="number" id="table_id" name="table_id" value="<?php echo htmlspecialchars($booking['table_id']); ?>" required>
        </div>

        <div class="form-group">
            <label for="parking_slot_count">Parking Slot Count:</label>
            <input type="number" id="parking_slot_count" name="parking_slot_count" value="<?php echo htmlspecialchars($booking['parking_slot_count']); ?>" required>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" value="<?php echo htmlspecialchars($booking['start_time']); ?>" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" value="<?php echo htmlspecialchars($booking['end_time']); ?>" required>
        </div>

        <div class="form-group">
            <button type="submit">Update Booking</button>
        </div>
    </form>
</body>
</html>
