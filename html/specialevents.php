<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Special Events</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .events-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .event-banner {
            background-image: url('your-event-banner-image.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 80px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .event-banner h1 {
            font-size: 40px;
            margin-bottom: 10px;
            color: #000; /* Set text color to black */
        }
        .event-banner p {
            font-size: 22px;
            margin-bottom: 20px;
            color: #000; /* Set text color to black */
        }
        .event-banner .btn {
            padding: 12px 25px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .event-banner .btn:hover {
            background-color: #0056b3;
        }
        .event-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .event-item {
            flex: 1;
            min-width: 300px;
            margin: 15px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .event-item img {
            max-width: 100%;
            border-radius: 10px;
        }
        .event-item h3 {
            font-size: 28px;
            margin-top: 15px;
        }
        .event-item p {
            font-size: 16px;
            margin: 15px 0;
        }
        .event-item .btn {
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
        .event-item .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="events-container">
        <div class="event-banner">
            <h1>Upcoming Special Events</h1>
            <p>Join us for exciting events and unforgettable experiences!</p>
            
        </div>

        <div class="event-section">
            <div class="event-item">
                <img src="../img/music1.webp" alt="Event 1">
                <h3>Music Night</h3>
                <p>Enjoy a night of live music with local bands and artists. Great food and drinks available!</p>
                <a href="#" class="btn">Learn More</a>
            </div>
            <div class="event-item">
                <img src="../img/wine1.webp" alt="Event 2">
                <h3>Wine Tasting</h3>
                <p>Explore a selection of fine wines from around the world. Perfect for connoisseurs and enthusiasts.</p>
                <a href="#" class="btn">Join Us</a>
            </div>
            <div class="event-item">
                <img src="../img/cooking.webp" alt="Event 3">
                <h3>Cooking Class</h3>
                <p>Learn from top chefs in an interactive cooking class. Great for food lovers and aspiring chefs.</p>
                <a href="#" class="btn">Sign Up</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
