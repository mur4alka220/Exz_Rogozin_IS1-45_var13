<?php
// Connect to database
$conn = mysqli_connect("exz", "root", "", "exz");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs to prevent SQL injection
$Email = mysqli_real_escape_string($conn, $_POST['Email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Check if Email and password are not empty
if (empty($Email) || empty($password)) {
  header("Location: error.html");
  exit;
}

// Check if Email and password match the data in the database
$sql = "SELECT * FROM Employee WHERE Email='$Email' AND password='$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
  header("Location: go.html");
  exit;
} else {
  header("Location: error.html");
  exit;
}

// Close connection
mysqli_close($conn);
?>  