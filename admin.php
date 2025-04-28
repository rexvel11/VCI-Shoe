<?php 
@include 'db.php';  // Include the database connection

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM shoes WHERE id = '$delete_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Shoe deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error: Could not delete the shoe.');</script>";
    }
}

// Fetch all shoes
$query = "SELECT * FROM shoes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="logo">
        <img src="img/download.jpg" alt="Big Brew Logo" />
      </div>
      <nav>
        <ul class="nav">
          <li><a href="index.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <button class="close-btn" id="closeBtn">&times;</button>
      <ul>
        <li><a href="index.php">Logout</a></li>
      </ul>
    </div>

    <!-- Admin Panel Section -->
    <div class="admin-panel">
      <div class="admin-header">
        <h2>All Shoes</h2>
        <a href="addShoes.php" class="add-btn">Add Shoe</a>
      </div>

      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Stocks</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($shoe = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $shoe['name']; ?></td>
              <td><?php echo $shoe['size']; ?></td>
              <td><?php echo $shoe['stocks']; ?></td>
              <td>$<?php echo $shoe['price']; ?></td>
              <td>
                <img src="<?php echo $shoe['image']; ?>" alt="<?php echo $shoe['name']; ?>" width="50" height="50" />
              </td>
              <td>
              <a href="addShoes.php?edit_id=<?php echo $shoe['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="admin.php?delete_id=<?php echo $shoe['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this shoe?');">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Footer -->
    <footer>
      <div class="footer-content">
        <p>&copy; 2024 Nike Store</p>
        <p>
          Follow us on <a href="#">Instagram</a>, <a href="#">Facebook</a>, <a href="#">TikTok</a>.
        </p>
      </div>
    </footer>

    <script src="index.js"></script>
  </body>
</html>
