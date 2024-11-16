<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: adlogin.php");
    exit();
}

// Handle form submission for registering a new coworker
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_coworker']) && isset($_POST['delete_id'])) {
        $delete_id = (int)$_POST['delete_id'];

        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $database = "galeryCafe";

        $conn = new mysqli($servername, $username_db, $password_db, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM coworkers WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "<p>Coworker deleted successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        // Existing code for registering a new coworker
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $contact_number = $_POST['contact_number'];

        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $database = "galeryCafe";

        $conn = new mysqli($servername, $username_db, $password_db, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO coworkers (email, password, name, birthday, contact_number) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $email, $password, $name, $birthday, $contact_number);

        if ($stmt->execute()) {
            echo "<p>Coworker registered successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}

// Database connection for fetching coworker data
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch coworker data
$sql = "SELECT id, name, email, birthday, contact_number FROM coworkers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/home.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <form action="admin_dashboard.php" method="post">
        <h2>Register Coworker</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>

        <label for="contact_number">Contact Number:</label>
        <input type="tel" id="contact_number" name="contact_number" required>

        <button type="submit">Register Coworker</button>
    </form>

    <h2>Coworkers List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Birthday</th>
        <th>Contact Number</th>
        <th>Actions</th> <!-- New column for actions -->
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
            <td>
                <!-- Add a delete button with a form -->
                <form action="admin_dashboard.php" method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete_coworker" onclick="return confirm('Are you sure you want to delete this coworker?');">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


    <?php
    $conn->close();
    ?>
</body>
</html>
