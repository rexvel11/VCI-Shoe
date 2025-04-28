<?php 
@include 'db.php';

$searchTerm = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$query = "SELECT * FROM shoes WHERE name LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($shoe = mysqli_fetch_assoc($result)) {
        echo '
        <div class="product-card" data-id="' . $shoe['id'] . '">
          <img src="' . $shoe['image'] . '" alt="' . $shoe['name'] . '" />
          <h4>' . $shoe['name'] . '</h4>
          <p>Stocks: ' . $shoe['stocks'] . '</p>
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
          <button class="add-to-cart" onclick="updateStock(' . $shoe['id'] . ')">Buy Now</button>
        </div>';
    }
} else {
    echo '<p>No shoes found matching your search.</p>';
}
?>
