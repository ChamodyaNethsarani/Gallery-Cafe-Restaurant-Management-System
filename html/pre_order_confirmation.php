<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "galeryCafe";

$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $preorder_date = $_POST['preorder_date'];
    $preorder_time = $_POST['preorder_time'];

    $stmt = $conn->prepare("INSERT INTO pre_orders (item_name, item_price, preorder_date, preorder_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $item_name, $item_price, $preorder_date, $preorder_time);

    if ($stmt->execute()) {
        echo "Pre-order saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order Confirmation</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 10px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1, h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .confirmation {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        p {
            margin: 10px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="confirmation">
            <h2>Pre-Order Confirmation</h2>
            <p>Thank you for pre-ordering!</p>
            <p>Item: <?php echo htmlspecialchars($item_name); ?></p>
            <p>Price: Rs. <?php echo htmlspecialchars($item_price); ?>.00</p>
            <p>Date: <?php echo htmlspecialchars($preorder_date); ?></p>
            <p>Time: <?php echo htmlspecialchars($preorder_time); ?></p>
            <button onclick="window.location.href='menu.php';">Return to Menu</button>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>

