<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../css/navbar1.css" />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <main>
      <section class="home" id="home">
        <div class="content">
          <h3>The Gallery Cafe</h3>
          <p>
            Welcome to Tasty Bites, where every meal is a culinary masterpiece
            delivered straight to your door. Explore a world of flavors with our
            diverse menu, curated from the finest ingredients and prepared by
            top chefs. Whether you're craving gourmet cuisine, comforting
            classics, or exotic dishes, SavorDelight promises a dining
            experience that's always fresh, delicious, and convenient. Order now
            and indulge in the delight of exceptional food, made just for you.
            Bon appétit!
          </p>
          <a href="menu.php" class="btn">order now</a>
        </div>

        <div class="image">
          <img src="../img/home-img.png" alt="" />
        </div>
      </section>

      <section class="speciality" id="speciality">
        <h1 class="heading">our's <span>special</span></h1>

        <div class="box-container">
          <div class="box">
            <img class="image" src="../img/s-img-1.jpg" alt="" />
            <div class="content">
              <img src="../img/s-1.png" alt="" />
              <h3>tasty burger</h3>
              <p>
                <span
                  >in our Tasty Burger, a perfect blend of succulent, premium
                  beef, fresh, crisp vegetables, and our signature sauce, all
                  nestled in a perfectly toasted bun. Each bite promises a burst
                  of mouthwatering flavors that will leave you craving more.
                  Experience burger perfection today!</span
                >
              </p>
            </div>
          </div>
          <div class="box">
            <img class="image" src="../img/s-img-2.jpg" alt="" />
            <div class="content">
              <img src="../img/s-2.png" alt="" />
              <h3>tasty pizza</h3>
              <p>
                <span
                  >Savor our Tasty Pizza, crafted with a crispy, golden crust,
                  rich tomato sauce, and the finest, freshest toppings. Melted
                  cheese and a perfect blend of herbs make every slice a
                  delightful experience. Enjoy a slice of pizza
                  perfection!</span
                >
              </p>
            </div>
          </div>
          <div class="box">
            <img class="image" src="../img/s-img-3.jpg" alt="" />
            <div class="content">
              <img src="../img/s-3.png" alt="" />
              <h3>cold ice-cream</h3>
              <p>
                <span
                  >Treat yourself to our Cold Ice Cream, a creamy, dreamy
                  delight that melts in your mouth. Choose from a variety of
                  rich, indulgent flavors, each crafted to perfection.
                  Refreshingly cool and irresistibly smooth, it's the perfect
                  treat for any time of day.</span
                >
              </p>
            </div>
          </div>
          <div class="box">
            <img class="image" src="../img/s-img-4.jpg" alt="" />
            <div class="content">
              <img src="../img/s-4.png" alt="" />
              <h3>cold drinks</h3>
              <p>
                <span
                  >Quench your thirst with our Cold Drinks, a refreshing
                  selection of beverages that offer a burst of cool,
                  invigorating flavors. Whether you prefer classic sodas,
                  sparkling waters, or fruity refreshments, each sip is a
                  delightful way to stay cool and refreshed. Enjoy the
                  chill!</span
                >
              </p>
            </div>
          </div>
          <div class="box">
            <img class="image" src="../img/s-img-5.jpg" alt="" />
            <div class="content">
              <img src="../img/s-5.png" alt="" />
              <h3>tasty sweets</h3>
              <p>
                <span
                  >Delight in our Tasty Sweets, a heavenly assortment of
                  desserts crafted to satisfy your sweet tooth. From decadent
                  cakes and pastries to creamy puddings and confections, each
                  treat is made with the finest ingredients for an indulgent
                  experience. Enjoy the sweetness in every bite!</span
                >
              </p>
            </div>
          </div>
          <div class="box">
            <img class="image" src="../img/s-img-6.jpg" alt="" />
            <div class="content">
              <img src="../img/s-6.png" alt="" />
              <h3>tasty breakfast</h3>
              <p>
                <span
                  >Start your day right with our Tasty Breakfast, featuring a
                  delicious array of morning favorites. From fluffy pancakes and
                  golden waffles to hearty omelets and fresh fruit bowls, every
                  dish is made to energize and satisfy. Enjoy a breakfast that's
                  both delicious and nourishing!</span
                >
              </p>
            </div>
          </div>
        </div>
      </section>

      <?php include 'footer.php'; ?>
      
    </main>
  </body>
</html>
