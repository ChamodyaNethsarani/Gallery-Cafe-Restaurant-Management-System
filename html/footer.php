<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      /* General footer styling */
footer {
 
  background-color: silver;
 width: 1500px;
  
}

/* Styling for footer sections */
.footer {
  padding: 0 20px; 
}



.footer-content h3 {
  font-size: 16px; 
  margin-bottom: 10px; 
}

.ul1, .ul2 {
  list-style: none;
  padding: 10px;
  margin: 0;
}

.ul1 li, .ul2 li {
  margin-bottom: 8px; 
}

.social-icons {
  padding: 0;
  margin: 0;
  list-style: none;
}

.social-icons li {
  display: inline;
  margin-right: 10px; /* Adjust space between social icons */
}

.credit {
  font-size: 8px; /* Reduce font size */
  margin-top: 10px; /* Adjust spacing above credit text */
  text-align: center; 
}

.credit a {
  color: #333; 
  text-decoration: none; 
  
}


    </style>
</head>
<body>


<!-- footer.php -->
<footer>
  <section class="footer">
    <div class="container">
      <div class="footer-content">
        <h3>Contact Us</h3>
        <ul class = "ul1">
          <li>Email: thegallerycafe@gmail.com</li>
          <li>Phone: +94 11 2 729 729</li>
          <li>Address: 179/c, Bandaragama, Kaluthara, Sri Lanka.</li>
        </ul>
      </div>
      <div class="footer-content">
        <h3>Quick Links</h3>
        <ul class = "ul2">
          <li><a href="#home">Home</a></li>
          <li><a href="#speciality">our's special</a></li>
          <li><a href="#popular">Special Event</a></li>
          <li><a href="#review">Promotions</a></li>
          <li><a href="#review">Admin</a></li>
        </ul>
      </div>
      <div class="footer-content">
        <h3>Follow Us</h3>
        <ul class="social-icons">
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          <li><a href="#"><i class="fab fa-youtube"></i></a></li>
          <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
          <li><a href="#"><i class="fab fa-github"></i></a></li>
          <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
        </ul>
      </div>
      <h1 class="credit">
        created by
        <span><a href="#">Chamodya Nethsarani</a></span> | all rights are
        reserved
      </h1>
    </div>
  </section>
</footer>
