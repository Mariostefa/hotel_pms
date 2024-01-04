<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "hotel";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Select the database
mysqli_select_db($conn, $name);


