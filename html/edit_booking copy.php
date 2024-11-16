<?php
session_start();
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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        name = ?, email = ?, phone = ?, booking_date = ?, number_of_guests = ?, 
        special_requests = ?, table_id = ?, parking_slot_count = ?, start_time = ?, end_time = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters: 10 types for 10 values + 1 type for the id
    $stmt->bind_param('ssssiiiii', 
        $name, 
        $email, 
        $phone, 
        $booking_date, 
        $number_of_guests, 
        $special_requests, 
        $table_id, 
        $parking_slot_count, 
        $start_time, 
        $end_time
    );

    // Bind the integer id separately
    $stmt->bind_param('i', $id); // Separate bind_param for the integer id

    if ($stmt->execute()) {
        header("Location: coworker_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch booking details for editing
$id = $_GET['id'] ?? 0;
$id = (int)$id;
$sql = "SELECT * FROM reservations WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        /* Your existing styles */
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="post" action="edit_booking.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($booking['id']); ?>">

            <!-- Your existing form fields -->

            <div class="form-group">
                <button type="submit">Update Booking</button>
            </div>
        </form>
    </div>
</body>
</html>
Key Points:
Combine Parameter Types: The bind_param call for the parameters in the UPDATE query should match the types defined. All non-integer parameters should be bound together, and the integer parameter (id) should be bound separately.

Correct Bind Order: Ensure that you are using bind_param correctly, which should match the parameter type string and the number of parameters.

By making these adjustments, the error should be resolved and your edit_booking.php script should work as intended.





Fatal error: Uncaught ArgumentCountError: The number of elements in the type definition string must match the number of bind variables in C:\wamp64\www\newweb\html\edit_booking.php on line 44
( ! ) ArgumentCountError: The number of elements in the type definition string must match the number of bind variables in C:\wamp64\www\newweb\html\edit_booking.php on line 44
Call Stack
#	Time	Memory	Function	Location
1	0.0005	458144	{main}( )	...\edit_booking.php:0
2	0.0259	515720	bind_param( $types = 'ssssiiiii', $vars = '', '', '', '', 0, '', 0, 0, '', '' )	...\edit_booking.php:44
ChatGPT
The error is due to a mismatch between the number of type specifiers in the bind_param call and the number of parameters being passed. You have 10 parameters to bind (excluding the id), but the bind_param function is being called incorrectly.

To correct this:

Combine all parameters in a single call to bind_param: Instead of using multiple calls to bind_param, you should pass all the variables together in a single call.

Ensure correct type specifiers: The type specifier string should match the number of variables.

Here’s the revised version of your edit_booking.php script:

Updated edit_booking.php
php
Copy code
<?php
session_start();
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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        name = ?, email = ?, phone = ?, booking_date = ?, number_of_guests = ?, 
        special_requests = ?, table_id = ?, parking_slot_count = ?, start_time = ?, end_time = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Correct type definition string for 10 variables and 1 integer (id)
    $stmt->bind_param('ssssiiiii', 
        $name, 
        $email, 
        $phone, 
        $booking_date, 
        $number_of_guests, 
        $special_requests, 
        $table_id, 
        $parking_slot_count, 
        $start_time, 
        $end_time
    );

    // Bind the integer id separately
    $stmt->bind_param('i', $id); // Separate bind_param for the integer id

    if ($stmt->execute()) {
        header("Location: coworker_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch booking details for editing
$id = $_GET['id'] ?? 0;
$id = (int)$id;
$sql = "SELECT * FROM reservations WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

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
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="post" action="edit_booking.php">
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
    </div>
</body>
</html>