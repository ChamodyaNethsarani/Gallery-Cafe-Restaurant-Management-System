<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order</title>
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
        input[type="date"],
        input[type="time"],
        input[type="text"] {
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
        <h1>Pre-Order</h1>
        <h2>Pre-Order Item</h2>
        <p>Item: <?php echo htmlspecialchars($item_name); ?></p>
        <p>Price: Rs. <?php echo htmlspecialchars($item_price); ?>.00</p>

        <form method="post" action="pre_order_confirmation.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="preorder_date">Select Date:</label>
            <input type="date" id="preorder_date" name="preorder_date" required>

            <label for="preorder_time">Select Time:</label>
            <input type="time" id="preorder_time" name="preorder_time" required>

            <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item_name); ?>">
            <input type="hidden" name="item_price" value="<?php echo htmlspecialchars($item_price); ?>">

            <button type="submit" class="btn">Confirm Pre-Order</button>
        </form>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>

<?php
}
?>
