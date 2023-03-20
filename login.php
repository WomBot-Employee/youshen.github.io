<?php
session_start();

if (isset($_SESSION['username'])) {
  header('Location: chat.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to MySQL database
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $dbname = 'mydatabase';
  $conn = new mysqli($host, $user, $pass, $dbname);
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  // Query the database to check if the user exists
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // User found, redirect to chat room
    $_SESSION['username'] = $username;
    header('Location: chat.php');
    exit();
  } else {
    // User not found, display error message
    $error_message = 'Invalid username or password.';
  }

  // Close the database connection
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($error_message)): ?>
    <p><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
