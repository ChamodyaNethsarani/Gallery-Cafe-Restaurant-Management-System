<?php
session_start();

// Check if the total price is set in the session
if (isset($_SESSION['total_price'])) {
    $total_price = $_SESSION['total_price'];
    // Optionally, clear the session data if you don't need it anymore
    unset($_SESSION['total_price']);
} else {
    // Handle the case where total_price is not set (e.g., direct access to the page)
    $total_price = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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

    <<main>
        <div class="confirmation">
            <h2>Order Confirmation</h2>
            <p>Thank you for your order!</p>
            <p>Total Price: Rs. <?php echo htmlspecialchars($total_price); ?>.00</p>
            <button onclick="window.location.href='menu.php';">Return to Menu</button>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>