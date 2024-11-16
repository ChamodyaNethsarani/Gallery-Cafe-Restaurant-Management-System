<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Promotions</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .promotions-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .promo-banner {
            background-image: url('your-banner-image.jpg');
            background-size: cover;
            background-position: center;
            color: #000; /* Set text color to black */
            text-align: center;
            padding: 60px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .promo-banner h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #000; /* Set text color to black */
        }
        .promo-banner p {
            font-size: 20px;
            margin-bottom: 20px;
            color: #000; /* Set text color to black */
        }
        .promo-banner .btn {
            padding: 10px 20px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .promo-banner .btn:hover {
            background-color: #ff4500;
        }
        .promo-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .promo-item {
            flex: 1;
            min-width: 300px;
            margin: 15px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .promo-item img {
            max-width: 100%;
            border-radius: 10px;
        }
        .promo-item h3 {
            font-size: 24px;
            margin-top: 15px;
        }
        .promo-item p {
            font-size: 16px;
            margin: 15px 0;
        }
        .promo-item .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .promo-item .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="promotions-container">
        <div class="promo-banner">
            <h1>Special Promotions</h1>
            <p>Don't miss out on our limited-time offers!</p>
            <a href="menu.php" class="btn">Shop Now</a>
        </div>

        <div class="promo-section">
            <div class="promo-item">
                <img src="../img/image.png" alt="Promotion 1">
                <h3>50% Off on All Beverages</h3>
                <p>Enjoy half-price on all beverages. Valid only for this weekend!</p>
                <a href="menu.php" class="btn">Learn More</a>
            </div>
            <div class="promo-item">
                <img src="../img/image1.webp" alt="Promotion 2">
                <h3>Buy 1 Get 1 Free</h3>
                <p>Buy any main course and get another one for free! Limited time offer.</p>
                <a href="menu.php" class="btn">Learn More</a>
            </div>
            <div class="promo-item">
                <img src="../img/image2.avif" alt="Promotion 3">
                <h3>20% Off for Members</h3>
                <p>Exclusive discount for our members. Sign up today to enjoy benefits.</p>
                <a href="menu.php" class="btn">Join Now</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
