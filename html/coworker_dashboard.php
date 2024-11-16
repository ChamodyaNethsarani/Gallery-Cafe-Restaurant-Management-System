





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
// Fetch data from all tables
$tables = [
    'bookings' => "SELECT * FROM reservations",
    'orders' => "SELECT * FROM orders",
    'pre_orders' => "SELECT * FROM pre_orders",
    'tables' => "SELECT * FROM tables"
];

$data = [];

foreach ($tables as $key => $sql) {
    $result = $conn->query($sql);
    if ($result) {
        $data[$key] = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $data[$key] = [];
        echo "Error fetching $key: " . $conn->error;
    }
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coworker Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        a {
            display: block;
            text-align: center;
            margin: 20px 0;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #555;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons form {
            margin: 0;
        }
        .action-buttons button {
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
        .update-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 3px;
        }
        .confirm-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
    <script>
        function confirmAction(form) {
            if (confirm("Are you sure you want to confirm this order?")) {
                form.submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        <p>You are logged in as a coworker.</p>

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
            <?php foreach ($data['bookings'] as $row) : ?>
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

        <h2>Orders</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Telephone Number</th>
                <th>Email</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($data['orders'] as $row) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['telephone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['order_date']); ?></td>

                    <td class="action-buttons">
    <form method="post" action="confirm_order.php" onsubmit="event.preventDefault(); confirmAction(this);">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="confirm-btn">Confirm</button>
    </form>
    <form method="post" action="delete_order.php" onsubmit="return confirm('Are you sure you want to delete this order?');">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="delete-btn">Delete</button>
    </form>
</td>

                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Pre-Orders</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Preorder Date</th>
                <th>Preorder Time</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($data['pre_orders'])): ?>
                <?php foreach ($data['pre_orders'] as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['item_price']); ?></td>
                        <td><?php echo htmlspecialchars($row['preorder_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['preorder_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_phone'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td class="action-buttons">
    <form method="post" action="confirm_pre_order.php" onsubmit="event.preventDefault(); confirmAction(this);">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="confirm-btn">Confirm</button>
    </form>
    <form method="post" action="delete_pre_order.php" onsubmit="return confirm('Are you sure you want to delete this pre-order?');">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="delete-btn">Delete</button>
    </form>
</td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No pre-orders found.</td>
                </tr>
            <?php endif; ?>
        </table>


        <a href="logout.php">Logout</a>
    </div>
</body>
</html>


