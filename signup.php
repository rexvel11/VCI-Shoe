<?php 
@include 'db.php';

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Check if email or username already exists
  $checkQuery = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
  $result = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Username or Email already exists!');</script>";
  } else {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
      echo "<script>alert('Registered successfully!'); window.location.href='index.php';</script>";
    } else {
      echo "<script>alert('Registration failed. Please try again.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Form</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="log.css" />
  </head>
  <body>
    <form action="" method="POST" class="login-form">
      <h1 class="login-title">Sign Up</h1>

      <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="input-box">
        <i class="bx bxs-envelope"></i>
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>

      <button type="submit" name="submit" class="login-btn">Sign Up</button>

      <p class="register">
        Already have an account?
        <a href="index.php">Login</a>
      </p>
      <p class="back"><a href="index.php">Go Back</a></p>
    </form>
  </body>
</html>
