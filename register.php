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
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);
$name_employee = mysqli_real_escape_string($conn, $_POST['name_employee']);
$position = mysqli_real_escape_string($conn, $_POST['position']);

// Check if username and password are not empty
if (empty($Email) || empty($password) || empty($password_confirm) || empty($name_employee) || empty($position)) {
  header("Location: error.html");
  exit;
}

// Check if password and confirm password match
if ($password != $password_confirm) {
  header("Location: error.html");
  exit;
}

// Check if email is valid
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
  header("Location: error.html");
  exit;
}

// Check if email contains Russian characters
if (preg_match('/[А-Яа-яЁё]/u', $Email)) {
  header("Location: error.html");
  exit;
}

// Insert user data into database
$sql = "INSERT INTO Employee (Email, password, name_employee, position) VALUES ('$Email', '$password', '$name_employee', '$position')";
if (mysqli_query($conn, $sql)) {
  echo "Аккаунт успешно создан!";
} else {
  echo "Error: " . $sql . " " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>