<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables_query = "SELECT id, table_number FROM tables";
$tables_result = $conn->query($tables_query);

if (!$tables_result) {
    echo "Error in query: " . $conn->error;
} else {
    $all_tables = [];
    while ($row = $tables_result->fetch_assoc()) {
        $all_tables[$row['id']] = $row['table_number'];
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $booking_date = trim($_POST['booking_date']);
    $number_of_guests = intval(trim($_POST['number_of_guests']));
    $special_requests = trim($_POST['special_requests']);
    $table_id = intval(trim($_POST['table_id']));
    $parking_slot_count = intval(trim($_POST['parking_slot_count']));
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    if (empty($name) || empty($email) || empty($booking_date) || empty($table_id)) {
        $error_message = "All fields are required";
    } else {
        // Check if the table is already booked
        $stmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE table_id = ? AND booking_date = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))");
        $stmt->bind_param("isssss", $table_id, $booking_date, $start_time, $start_time, $end_time, $end_time);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error_message = "The selected table is already booked for the chosen time slot.";
        } else {
            // Check parking slot availability
            $stmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE parking_slot_count = ? AND booking_date = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))");
            $stmt->bind_param("isssss", $parking_slot_count, $booking_date, $start_time, $start_time, $end_time, $end_time);
            $stmt->execute();
            $stmt->bind_result($slot_count);
            $stmt->fetch();
            $stmt->close();

            if ($slot_count > 0) {
                $error_message = "The selected parking slots are not available for the chosen time slot.";
            } else {
                // Insert reservation into database
                $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, booking_date, number_of_guests, special_requests, table_id, parking_slot_count, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdisiiss", $name, $email, $phone, $booking_date, $number_of_guests, $special_requests, $table_id, $parking_slot_count, $start_time, $end_time);

                if ($stmt->execute()) {
                    $success_message = "Booking successful!";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}

// Fetch booked tables for the selected date and time
$booked_query = "
    SELECT table_id
    FROM reservations
    WHERE booking_date = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))
";
$stmt = $conn->prepare($booked_query);
$stmt->bind_param("sssss", $booking_date, $start_time, $start_time, $end_time, $end_time);
$stmt->execute();
$booked_result = $stmt->get_result();

$booked_tables = [];
while ($row = $booked_result->fetch_assoc()) {
    $booked_tables[] = $row['table_id'];
}
$stmt->close();

// Remove booked tables from the list of all tables
$available_tables = array_diff_key($all_tables, array_flip($booked_tables));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book a Table</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" />
    <style>
        .booking-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        input[type="time"],
        textarea,
        select {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #555;
        }
        .error-message,
        .success-message {
            text-align: center;
            margin-bottom: 15px;
        }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
        .tables-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 20px;
            text-align: center;
        }
        .table-button {
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .table-button.selected {
            background-color: #4CAF50;
            color: white;
        }
        .table-button.booked {
            background-color: #f44336;
            color: white;
            cursor: not-allowed;
        }
        .table-button:disabled {
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    </br></br></br></br></br></br></br></br></br></br></br>

    <div class="booking-container">
        <h2>Book a Table</h2>

        <?php
        if ($error_message) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        if ($success_message) {
            echo '<div class="success-message">' . $success_message . '</div>';
        }
        ?>

        <form id="booking-form" action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" />

            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required />

            <label for="number_of_guests">Number of Guests:</label>
            <input type="number" id="number_of_guests" name="number_of_guests" min="1" required />

            <label for="special_requests">Special Requests:</label>
            <textarea id="special_requests" name="special_requests"></textarea>

            <label for="parking_slot_count">Number of Parking Slots:</label>
            <input type="number" id="parking_slot_count" name="parking_slot_count" min="0" max="10" />

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required />

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required />

            <label for="table_id">Select Table:</label>
            <div class="tables-container">
                <?php foreach ($available_tables as $table_id => $table_number) { ?>
                    <button type="button" class="table-button" data-table-id="<?php echo $table_id; ?>">
                        Table <?php echo $table_number; ?>
                    </button>
                <?php } ?>
            </div>
            <input type="hidden" id="table_id" name="table_id" value="" required />

            <button type="submit">Book Now</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableButtons = document.querySelectorAll('.table-button');
            const tableIdInput = document.getElementById('table_id');

            tableButtons.forEach(button => {
                button.addEventListener('click', function () {
                    tableButtons.forEach(btn => btn.classList.remove('selected'));
                    this.classList.add('selected');
                    tableIdInput.value = this.getAttribute('data-table-id');
                });
            });
        });
    </script>
</body>
</html>
