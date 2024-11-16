<?php
session_start();

 $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "galeryCafe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo "Username and Password are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $db_username, $db_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $db_password)) {
                // Start the session
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $db_username;
                
                // Redirect to the home page
                header("Location: home.html");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username or email.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
