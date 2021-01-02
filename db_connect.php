<?php
$conn = new mysqli("localhost", "root", "","trial");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
