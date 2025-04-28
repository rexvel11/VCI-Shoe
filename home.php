<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username']; // Get the username from session

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();  // Unset session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to the home page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nike Store</title>
    <link rel="stylesheet" href="index.css" />
    <style>
      .search-container {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

#searchBar {
  width: 300px;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#searchBtn {
  padding: 10px 20px;
  margin-left: 10px;
  background-color: #000;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

#searchBtn:hover {
  background-color: #555;
}

    </style>
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="img/download.jpg" alt="Nike Logo" />
      </div>
      <nav>
        <ul class="nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="home.php?logout=true">Logout</a></li>
        </ul>
      </nav>
      <div class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </header>

    <div class="sidebar" id="sidebar">
      <button class="close-btn" id="closeBtn">&times;</button>
      <ul>
      <li><a href="index.php">Home</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="home.php?logout=true">Logout</a></li>
      </ul>
    </div>

    <section id="home" class="hero">
      <div class="hero-overlay">
        <div class="hero-content">
          <h1>Welcome to Nike Store</h1>
          <p>Step into comfort and style with our latest collection!</p>
          <a href="#categories" class="shop-now-button">Shop Now</a>
        </div>
      </div>
    </section>

    <section id="gif">
      <div class="gif1">
        <img src="img/vid2.gif" alt="gif" />
      </div>
    </section>

    <section id="best-sellers">
      <h2>Jordan 4's</h2>
      <div class="best-sellers-images">
        <div class="best-seller-item">
          <img src="img/j4-1.jpg" alt="Best Seller 1" />
        </div>
        <div class="best-seller-item">
          <img src="img/j4-2.jpg" alt="Best Seller 2" />
        </div>
        <div class="best-seller-item">
          <img src="img/j4-3.jpg" alt="Best Seller 3" />
        </div>
      </div>
    </section>

    <section id="categories">
      <h2>Categories</h2>

      <div class="category">
        <div class="category-header">
          <h3>Air Max's</h3>
        </div>
        <div class="carousel">
          <div class="carousel-images">
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max 2013 Men's Shoes (Desert Sand).jpg"
                  alt="Milk Tea 1"
                />
                <h4>Nike Air Max 2013</h4>
                <p>Men'<s></s></p>
                <p>Desert Sand</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max 2013 Men's Shoes (White).jpg"
                  alt="Milk Tea 2"
                />
                <h4>Nike Air Max 2013</h4>
                <p>Men's</p>
                <p>White</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max 270 Men's Shoes (White).jpg"
                  alt="Milk Tea 3"
                />
                <h4>Nike Air Max 270</h4>
                <p>Men's</p>
                <p>White</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max Ishod Men's Shoes (White).jpg"
                  alt="Milk Tea 4"
                />
                <h4>Nike Air Max Ishod</h4>
                <p>Men's</p>
                <p>White</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max Pulse Men's Shoes (Neutral Olive).jpg"
                  alt="Milk Tea 5"
                />
                <h4>Nike Air Max Pulse</h4>
                <p>Men's</p>
                <p>Neutral Olive</p>
              </div>
            </div>
          </div>
          <button class="carousel-button prev">←</button>
          <button class="carousel-button next">→</button>
        </div>
      </div>

      <div class="category">
        <div class="category-header">
          <h3>Dunk's</h3>
        </div>
        <div class="carousel">
          <div class="carousel-images">
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Dunk Low Retro Men's Shoes (White).jpg"
                  alt="Iced Coffee 1"
                />
                <h4>Nike Dunk Low</h4>
                <p>Men/Womens</p>
                <p>Olive Green</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/NIKE Dunk Low Retro Sp 'st_ John's - Red.jpg"
                  alt="Iced Coffee 3"
                />
                <h4>Nike Dunk Low</h4>
                <p>Men's</p>
                <p>Red</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike - Zapatillas casual de hombre Dunk Low Retro Nike.jpg"
                  alt="Iced Coffee 4"
                />
                <h4>Nike Dunk Low</h4>
                <p>Men/Women</p>
                <p>Panda</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Dunk Low Championship Court Purple - US 6 - EU 38_5.jpg"
                  alt="Iced Coffee 5"
                />
                <h4>Nike Dunk Low</h4>
                <p>Men/Women</p>
                <p>Purple</p>
              </div>
            </div>
          </div>
          <button class="carousel-button prev">←</button>
          <button class="carousel-button next">→</button>
        </div>
      </div>

      <div class="category">
        <div class="category-header">
          <h3>Runner's</h3>
        </div>
        <div class="carousel">
          <div class="carousel-images">
            <div class="carousel-item">
              <div class="product-card1">
                <img src="img/Nike V2K Run Shoes (2).jpg" alt="Fruit Tea 1" />
                <h4>Nike V2K</h4>
                <p>Men/Women</p>
                <p>Ash Gray</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Initiator Women's Shoes.jpg"
                  alt="Fruit Tea 2"
                />
                <h4>Nike Initiator</h4>
                <p>Women's</p>
                <p>White</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Zoom Pegasus 38 Running Shoes White Silver Cw7358 100 - Size 9_5 Womens.jpg"
                  alt="Fruit Tea 3"
                />
                <h4>Nike Air Zoom Pegasus 38</h4>
                <p>Men/Women</p>
                <p>White Silver</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img
                  src="img/Nike Air Max Plus Zapatillas - Mujer.jpg"
                  alt="Fruit Tea 4"
                />
                <h4>Nike Air Plus</h4>
                <p>Women's</p>
                <p>White Pink</p>
              </div>
            </div>
            <div class="carousel-item">
              <div class="product-card1">
                <img src="img/Nike V2K Run Shoes.jpg" alt="Fruit Tea 4" />
                <h4>Nike V2K</h4>
                <p>Men/Women</p>
                <p>White</p>
              </div>
            </div>
          </div>
          <button class="carousel-button prev">←</button>
          <button class="carousel-button next">→</button>
        </div>
      </div>
    </section>

    <section id="gif">
      <div class="gif1">
        <img src="img/vid.gif" alt="gif" />
      </div>
    </section>

    <section id="about">
      <h2>About Us</h2>
      <p>
        Welcome to the Nike Store, your destination for the latest and greatest
        in Nike footwear. We are passionate about empowering athletes and
        enthusiasts with innovative products that inspire performance and style.
        Whether you're training, competing, or just looking for everyday
        comfort, we bring you the best from Nike's iconic collections.
      </p>
      <br />
      <p>
        At our store, we believe in fostering a community that celebrates sport,
        creativity, and individuality. Explore our range and discover the
        perfect fit for your goals and lifestyle. Let’s move together—just do
        it!
      </p>
    </section>

    <footer>
      <div class="footer-content">
        <p>&copy; 2024 Nike Store</p>
        <p>
          Follow us on <a href="website didi">Instagram</a>,
          <a href="website didi">Facebook</a>,
          <a href="url palan hahha">TikTok</a>.
        </p>
      </div>
    </footer>

    <script src="index1.js"></script>
  </body>
</html>
