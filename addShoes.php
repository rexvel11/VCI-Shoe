<?php
@include 'db.php';  // Include the database connection
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
  $query = "SELECT * FROM shoes WHERE id = '$edit_id'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
      $editShoe = mysqli_fetch_assoc($result);
  } else {
      echo "<script>alert('Shoe not found.');</script>";
  }
}

// Fetch shoe data if editing
$editShoe = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $query = "SELECT * FROM shoes WHERE id = '$edit_id'";
    $result = mysqli_query($conn, $query);
    $editShoe = mysqli_fetch_assoc($result);
}

// Handle form submission (Add or Update Shoe)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $stocks = mysqli_real_escape_string($conn, $_POST['stocks']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $photo = $_FILES['photo'];

    $photoNewName = null;
    $photoDestination = null;

    if ($photo['error'] === 0) {
        $photoNewName = uniqid('', true) . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
        $photoDestination = 'uploads/' . $photoNewName;
        if (!move_uploaded_file($photo['tmp_name'], $photoDestination)) {
            echo "<script>alert('Error uploading photo.');</script>";
        }
    }

    if (isset($_POST['edit_id'])) {
        // Update shoe
        $edit_id = $_POST['edit_id'];
        $updateQuery = "UPDATE shoes SET name='$name', size='$size', stocks='$stocks', price='$price', image='$photoDestination' WHERE id='$edit_id'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Shoe updated successfully!'); window.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Error: Could not update the shoe details.');</script>";
        }
    } else {
        // Add new shoe
        $query = "INSERT INTO shoes (name, size, stocks, price, image) VALUES ('$name', '$size', '$stocks', '$price', '$photoDestination')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Shoe added successfully!'); window.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Error: Could not save the shoe details. " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="index.css" />
    <style>
        .admin-panel {
            max-width: 700px;
            margin: 50px auto;
            background: #f9f9f9;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .admin-panel h2 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        .submit-btn {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .image-preview {
            margin-top: 15px;
            width: 100%;
            height: 200px;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            color: #888;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
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

    <div class="admin-panel">
        <h2 id="formTitle">Add New Shoe</h2>
        <form id="shoeForm" action="addShoes.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Shoe Name</label>
                <input type="text" id="name" name="name" placeholder="Enter shoe name" value="<?php echo $editShoe ? $editShoe['name'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" id="size" name="size" placeholder="Enter shoe size" value="<?php echo $editShoe ? $editShoe['size'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="stocks">Stocks</label>
                <input type="text" id="stocks" name="stocks" placeholder="Enter number of stocks" value="<?php echo $editShoe ? $editShoe['stocks'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="text" id="price" name="price" placeholder="Enter price" value="<?php echo $editShoe ? $editShoe['price'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="photo">Upload Shoe Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)" <?php echo $editShoe ? '' : 'required'; ?> />
            </div>

            <button type="submit" class="submit-btn">
                <?php echo $editShoe ? 'Update Shoe' : 'Add Shoe'; ?>
            </button>

            <!-- Hidden Input for Edit -->
            <?php if ($editShoe): ?>
                <input type="hidden" name="edit_id" value="<?php echo $editShoe['id']; ?>" />
            <?php endif; ?>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Nike Store</p>
        </div>
    </footer>

    <script>
        // Preview Image Function
        function previewImage(event) {
            const previewBox = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewBox.innerHTML = '<img src="' + e.target.result + '" alt="Shoe Image Preview">';
                };
                
                reader.readAsDataURL(file);
            }
        }

        // If we are editing, change form title
        if (<?php echo $editShoe ? 'true' : 'false'; ?>) {
            document.getElementById("formTitle").innerText = "Edit Shoe";
        }
    </script>
</body>
</html>
