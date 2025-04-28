<?php 
session_start();
@include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Fetch all shoes initially
$query = "SELECT * FROM shoes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery</title>
  <link rel="stylesheet" href="index.css" />
  <style>
/* Search Bar Styling */
.search-bar {
  margin: 20px auto;
  text-align: center;
}
.search-bar input {
  width: 300px;
  max-width: 90%;
  padding: 12px 20px;
  border: 2px solid #ccc;
  border-radius: 50px;
  font-size: 16px;
  outline: none;
  transition: 0.3s;
}
.search-bar input:focus {
  border-color: #4CAF50;
  box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
}
</style>

</head>
<body>
  <!-- Header -->
  <header>
    <div class="logo">
      <img src="img/download.jpg" alt="Big Brew Logo" />
    </div>
    <nav>
      <ul class="nav">
        <li><a href="home.php">Home</a></li>
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

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <button class="close-btn" id="closeBtn">&times;</button>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="#about">About Us</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="home.php?logout=true">Logout</a></li>
    </ul>
  </div>

  <!-- Gallery Section -->
  <section id="gallery">
    <h1>Product Gallery</h1>

    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search for a shoe..." />
    </div>

    <div class="gallery-container" id="galleryContainer">
      <?php while ($shoe = mysqli_fetch_assoc($result)) { ?>
        <div class="product-card" data-id="<?php echo $shoe['id']; ?>">
          <img src="<?php echo $shoe['image']; ?>" alt="<?php echo $shoe['name']; ?>" />
          <h4><?php echo $shoe['name']; ?></h4>
          <p>Stocks: <?php echo $shoe['stocks']; ?></p>
          <h4>Shoe Size Options</h4>
          <p>Select your size and quantity:</p>
          <div class="size-options">
            <button class="size-button">6</button>
            <button class="size-button">6.5</button>
            <button class="size-button">7</button>
            <button class="size-button">7.5</button>
            <button class="size-button">8</button>
          </div>
          <div class="quantity-selector">
            <button class="quantity-btn minus">-</button>
            <input type="text" class="quantity-display" value="0" readonly />
            <button class="quantity-btn plus">+</button>
          </div>
          <button class="add-to-cart" onclick="updateStock(<?php echo $shoe['id']; ?>)">Buy Now</button>
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about">
    <h2>About Us</h2>
    <p>
      Welcome to the Nike Store, your destination for the latest and greatest
      in Nike footwear. We are passionate about empowering athletes and
      enthusiasts with innovative products that inspire performance and style.
    </p>
    <br />
    <p>
      At our store, we believe in fostering a community that celebrates sport,
      creativity, and individuality. Explore our range and discover the
      perfect fit for your goals and lifestyle. Let’s move together—just do
      it!
    </p>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <p>&copy; 2024 Nike Store</p>
      <p>
        Follow us on <a href="#">Instagram</a>, <a href="#">Facebook</a>,
        <a href="#">TikTok</a>.
      </p>
    </div>
  </footer>

  <!-- JS -->
  <script src="index1.js"></script>

  <script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
      const query = this.value;

      const xhr = new XMLHttpRequest();
      xhr.open('GET', 'search_shoes.php?query=' + encodeURIComponent(query), true);

      xhr.onload = function() {
        if (this.status === 200) {
          document.getElementById('galleryContainer').innerHTML = this.responseText;
        }
      };

      xhr.send();
    });
  </script>
</body>
</html>
