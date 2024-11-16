<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];

    // Add item to cart
    $_SESSION['cart'][] = ['name' => $item_name, 'price' => $item_price];
}

// Handle removing items from the cart
if (isset($_POST['remove_from_cart'])) {
    $index = $_POST['item_index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
}

// Calculate total price
$total_price = array_sum(array_column($_SESSION['cart'], 'price'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
<link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
   
    <link rel="stylesheet" href="../css/cart.css"> <!-- Include the new CSS file -->
</head>
<body>

<main>
    <div class="cart-container">
        <h1>Your Cart</h1>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>Rs. <?php echo htmlspecialchars($item['price']); ?>.00</td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                    <button type="submit" name="remove_from_cart" value="1" class="btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Total Price: Rs. <?php echo $total_price; ?>.00</h2>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</main>
</body>
</html>