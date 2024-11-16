<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Sample items (replace with database query in production)
$items = [
    ['name' => 'Tasty Burger', 'price' => 450, 'img' => '../img/p-1.jpg'],
    ['name' => 'Tasty Cakes', 'price' => 2100, 'img' => '../img/p-2.jpg'],
    ['name' => 'Tasty Sweets', 'price' => 350, 'img' => '../img/p-3.jpg'],
    ['name' => 'Tasty Cupcakes', 'price' => 600, 'img' => '../img/p-4.jpg'],
    ['name' => 'Cold Drinks', 'price' => 120, 'img' => '../img/p-5.jpg'],
    ['name' => 'Tasty Ice-creams', 'price' => 380, 'img' => '../img/p-6.jpg'],
];

// Handle search functionality
$search_results = $items;
if (isset($_GET['search_query'])) {
    $query = strtolower($_GET['search_query']);
    $search_results = array_filter($items, function($item) use ($query) {
        return strpos(strtolower($item['name']), $query) !== false;
    });
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $_SESSION['cart'][] = ['name' => $item_name, 'price' => $item_price];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <br><br><br><br><br>

    <form method="get" action="menu.php">
        <input type="text" name="search_query" placeholder="Search for foods..." />
        <button type="submit" class="btn">Search</button>
    </form>


    <section class="popular" id="popular">
    <h1 class="heading">Our <span>Popular</span> Foods</h1>
    <div class="box-container">
        <?php foreach ($search_results as $item) : ?>
            <div class="box">
                <span class="price">RS. <?= $item['price']; ?></span>
                <img src="<?= $item['img']; ?>" alt="<?= $item['name']; ?>">
                <h3><?= $item['name']; ?></h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <form method="post">
                    <input type="hidden" name="item_name" value="<?= $item['name']; ?>">
                    <input type="hidden" name="item_price" value="<?= $item['price']; ?>">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="<?= $item['name']; ?>">
                    <input type="hidden" name="item_price" value="<?= $item['price']; ?>">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="gallery" id="gallery">
    <h1 class="heading">our food <span>gallery</span></h1>
    <div class="box-container">
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <img src="../img/g-1.jpg" alt="Tasty Burger">
            <div class="content">
                <h3>Tasty Burger</h3>
                <p>Absolutely delicious! The Tasty Burger was juicy and flavorful, easily the best burger I've had in a long time.</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Burger">
                    <input type="hidden" name="item_price" value="175">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Burger">
                    <input type="hidden" name="item_price" value="175">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <!-- Repeat the structure for each item -->
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <img src="../img/g-3.jpg" alt="Tasty Food">
            <div class="content">
                <h3>Tasty Food</h3>
                <p>Breakfast here is amazing! The pancakes were fluffy, and the omelet was packed with fresh ingredients. A great way to start the day!</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Food">
                    <input type="hidden" name="item_price" value="275">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Food">
                    <input type="hidden" name="item_price" value="275">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <<div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
               <img src="../img/g-4.jpg" alt="Tasty Bites">
            <div class="content">
                <h3>Tasty Bites</h3>
                <p>The cupcakes from TastyBites are absolutely delightful! They're moist, flavorful, and beautifully decorated. Each bite is a little piece of heaven. I can't resist ordering them for every special occasion!</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Bites">
                    <input type="hidden" name="item_price" value="375">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Bites">
                    <input type="hidden" name="item_price" value="375">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
               <img src="../img/g-5.jpg" alt="Tasty Sweets">
            <div class="content">
                <h3>Tasty Sweets</h3>
                <p>The Tasty Sweets are simply divine. Every bite of the cake was moist and delicious. A real treat!</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Sweets">
                    <input type="hidden" name="item_price" value="475">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Sweets">
                    <input type="hidden" name="item_price" value="475">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <img src="../img/p-5.jpg" alt="Cold Drinks">
            <div class="content">
                <h3>Cold Drinks</h3>
                <p>The Cold Drinks are so refreshing and full of flavor. They were the perfect complement to my meal.</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Cold Drinks">
                    <input type="hidden" name="item_price" value="575">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Cold Drinks">
                    <input type="hidden" name="item_price" value="575">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
               <img src="../img/g-8.jpg" alt="Tasty Chocolate">
            <div class="content">
                <h3>Tasty Chocolate</h3>
                <p>Tasty chocolate from TastyBites are simply delicious! They never fail to satisfy my sweet cravings. Perfect for indulging or sharing with friends.</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Chocolate">
                    <input type="hidden" name="item_price" value="675">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Chocolate">
                    <input type="hidden" name="item_price" value="675">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
        <div class="box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
             <img src="../img/p-6.jpg" alt="Tasty Cold Ice Cream">
            <div class="content">
                <h3>Tasty Cold Ice Cream</h3>
                <p>Cold Ice Cream from TastyBites is a real treat! Creamy, smooth, and oh-so-satisfying. Whether you're cooling off on a hot day or just need a sweet pick-me-up, their ice cream hits the spot every time. Definitely a must-try!</p>
                <form method="post">
                    <input type="hidden" name="item_name" value="Tasty Cold Ice Cream">
                    <input type="hidden" name="item_price" value="775">
                    <button type="submit" name="add_to_cart" value="1" class="btn">Add to Cart</button>
                </form>
                <form method="post" action="pre_order.php">
                    <input type="hidden" name="item_name" value="Tasty Cold Ice Cream">
                    <input type="hidden" name="item_price" value="775">
                    <button type="submit" class="btn">Pre-Order</button>
                </form>
            </div>
        </div>
    </div><?php include 'cart.php'; ?>
</section>



    

    <?php include 'footer.php'; ?>
</main>
</body>
</html>
