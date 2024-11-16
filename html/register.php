<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "galeryCafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form validation
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $birthday = trim($_POST['birthday']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email) || empty($contact) || empty($birthday) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) {
        $error_message = "Invalid contact number format. Should be 10 digits.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO customer (name, email, contact, birthday, password) VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $contact, $birthday, $password);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Form</title>
    <link rel="stylesheet" href="styles.css" /> <!-- Assuming you have a CSS file -->
    
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
   

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 40px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h2 {
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
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
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
        input[type="submit"]:hover {
            background-color: #555;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
        a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #555;
        }
        footer {
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <form id="registrationForm" action="register.php" method="post">
        <h2>Registration Form</h2>

        <?php if (!empty($error_message)) : ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Username" required /><br /><br />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required /><br /><br />

        <label for="contact">Contact Number</label>
        <input type="text" id="contact" name="contact" placeholder="Contact Number (10 digits)" required /><br /><br />

        <label for="birthday">Birthday</label>
        <input type="date" id="birthday" name="birthday" required /><br /><br />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password must be at least 6 characters" required /><br /><br />

        <input type="submit" value="Register" />
    </form>

    <br><br><br><br><br>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
