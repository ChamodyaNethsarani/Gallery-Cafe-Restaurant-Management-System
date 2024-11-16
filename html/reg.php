<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* Styles for the popup */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        #popup p {
            margin: 0;
            padding: 5px 0;
            color: red;
        }
        #popup .close {
            display: block;
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div id="popup">
    <div id="popup-content"></div>
    <a href="#" class="close" onclick="closePopup()">Close</a>
</div>

<form method="POST" action="">
    <!-- Form fields -->
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="contact" placeholder="Contact">
    <input type="date" name="birthday" placeholder="Birthday">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Register</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $contact = htmlspecialchars(trim($_POST['contact']));
    $birthday = htmlspecialchars(trim($_POST['birthday']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate contact
    if (empty($contact)) {
        $errors[] = "Contact is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) { // Assuming 10-digit phone number
        $errors[] = "Invalid contact number. Must be 10 digits.";
    }

    // Validate birthday
    if (empty($birthday)) {
        $errors[] = "Birthday is required.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If there are errors, display them in the popup
    if (!empty($errors)) {
        echo "<script>
            var popupContent = document.getElementById('popup-content');
            var errors = " . json_encode($errors) . ";
            popupContent.innerHTML = '';
            errors.forEach(function(error) {
                var p = document.createElement('p');
                p.textContent = error;
                popupContent.appendChild(p);
            });
            document.getElementById('popup').style.display = 'block';
        </script>";
    } else {
        // Process the data (e.g., save to database)
        echo "<p style='color:green;'>Registration successful!</p>";
    }
}
?>

<script>
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>

</body>
</html>
