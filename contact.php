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
    <title>Contact</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="img/download.jpg" alt="Nike Logo" />
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

    <section id="contact" class="contact-section">
      <h2>Contact Us</h2>
      <p>
        We'd love to hear from you! Please use the form below to get in touch
        with us.
      </p>
      <form action="#" method="post" class="contact-form">
        <label for="name">Name:</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Your name"
          required
        />

        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Your email"
          required
        />

        <label for="message">Message:</label>
        <textarea
          id="message"
          name="message"
          rows="5"
          placeholder="Your message"
          required
        ></textarea>

        <button type="submit">Send Message</button>
      </form>
    </section>

    <!-- About Us Section -->
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

    <script src="index.js"></script>
  </body>
</html>
