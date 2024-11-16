<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Initialize cart if not already done
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit();
}

// Calculate total price
$total_price = array_sum(array_column($_SESSION['cart'], 'price'));

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $telephone_number = $_POST['telephone_number'];
    $email = $_SESSION['email'];

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

    // Prepare and execute the statement
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, address, telephone_number, email, total_price) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $customer_name, $address, $telephone_number, $email, $total_price);
    
    if ($stmt->execute()) {
        // Store total price in session for confirmation page
        $_SESSION['total_price'] = $total_price;

        // Clear cart after order is placed
        unset($_SESSION['cart']);
        
        // Redirect to order confirmation page
        header("Location: order_confirmation.php");
        exit();
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
    <title>Checkout</title>
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
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        h3 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            display: block;
            text-align: left;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
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
        button[type="submit"]:hover {
            background-color: #555;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

 <main>
        <h1>Checkout</h1>
        <h3>Total Price: Rs. <?php echo $total_price; ?>.00</h3>
        <form action="checkout.php" method="post">
            <label for="customer_name">Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="telephone_number">Telephone Number:</label>
            <input type="text" id="telephone_number" name="telephone_number" required>

            <button type="submit" class="btn">Place Order</button>
        </form>
    </main>

<?php include 'footer.php'; ?>

</body>
</html>
