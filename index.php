<?php 
@include 'db.php';
session_start();

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Fetch user by username
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Verify password
    if (password_verify($password, $user['password'])) {
      // Login successful
      $_SESSION['username'] = $user['username'];

      // Check if username is 'admin'
      if ($user['username'] === 'admin') {
        // Redirect to admin.php
        echo "<script>alert('Login Successful!'); window.location.href='admin.php';</script>";
      } else {
        // Redirect to home.php for regular users
        echo "<script>alert('Login Successful!'); window.location.href='home.php';</script>";
      }
    } else {
      echo "<script>alert('Invalid password.');</script>";
    }
  } else {
    echo "<script>alert('Username not found.');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="log.css">
  </head>
  <body>
    <form action="" method="POST" class="login-form">
      <h1 class="login-title">Login</h1>

      <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>

      <button type="submit" name="submit" class="login-btn">Login</button>

      <p class="register">
        Don't have an account?
        <a href="signup.php">Register</a>
      </p>
      <p class="back"><a href="index.php">Go Back</a></p>
    </form>
  </body>
</html>
