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

// Fetch bookings data
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
$bookings = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <style>
        /* Your CSS styling here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .update-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .update-btn {
            background-color: #4CAF50;
            color: white;
        }
        .update-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <h2>Bookings</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Booking Date</th>
            <th>Number of Guests</th>
            <th>Special Requests</th>
            <th>Table ID</th>
            <th>Parking Slot Count</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($bookings as $row) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                <td><?php echo htmlspecialchars($row['number_of_guests']); ?></td>
                <td><?php echo htmlspecialchars($row['special_requests']); ?></td>
                <td><?php echo htmlspecialchars($row['table_id']); ?></td>
                <td><?php echo htmlspecialchars($row['parking_slot_count']); ?></td>
                <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                <td class="action-buttons">
                    <form method="get" action="edit_booking.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="update-btn">Edit</button>
                    </form>
                    <form method="post" action="delete_booking.php" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
