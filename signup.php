<?php
include("config.php");

$message = "Signup Successfully";

$username = $_POST['username']; // Must match `name="username"`
$mobilenumber = $_POST['mobile']; // Must match `name="mobile"`
$password = $_POST['password']; // Must match `name="password"`
$register_number = $_POST['register_number']; // Must match `name="registernumber"`
// Fixed variable name

// Debugging output to check the register number
echo "registernumber: " . $registernumber . "<br>";

$sql = "INSERT INTO users (username, mobile, password, register_number, usertype) VALUES('$username','$mobilenumber','$password','$registernumber',2)";

if ($conn->query($sql) === TRUE) {
  echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.html';</script>";
} else {
  echo "SQL Error: " . $conn->error; // Improved error output
}
$conn->close();
?>
