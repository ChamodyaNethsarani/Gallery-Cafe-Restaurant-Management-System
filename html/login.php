
    <?php
    session_start();

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "galeryCafe";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM customer WHERE email=?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify the password
            if ($password === $hashed_password) {
                $_SESSION['email'] = $email;
                header("Location: menu.php"); // Redirect to menu page after successful login
                exit(); // Ensure no further code execution after redirect
             } else {
                $_SESSION['email'] = $email;
                header("Location: menu.php"); // Redirect to menu page after successful login
                exit(); // Ensure no further code execution after redirect
            $error_message = "Invalid email or password";

        }
    } else {
        $error_message = "Invalid email or password";
    }

        // Close connections
        $stmt->close();
    }
        // Fetch customer data
    $sql = "SELECT name, email, contact, birthday FROM customer";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "<div class='error-message'>Error: " . $conn->error . "</div>";
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        footer {
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            margin-top: 60px; /* Adjusted for navbar */
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            display: block;
        }
        input[type="text"],
        input[type="password"] {
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
        a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <br><br><br><br><br><br>

    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($error_message)) : ?>
            <div class="error-message" style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form id="loginForm" action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Login</button>

            <a href="/forgot-password">Forgot Password?</a>
        </form>

        <div class="register-section">
            <br />
            <a href="register.php">Don't have an account?</a>
        </div>
    </div>
    <br><br><br><br>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
