<?php
// Script 1: Database connection
$servername = "localhost";
$username = "nztechma_nztech";
$password = '~#{[z2_}"&]';
$database = "nztechma_nazihplatform";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Website</title>
</head>
<body>
  <h1>Welcome to Your Website</h1>

  <?php
  // Script 2: Database operations
  $sql = "SELECT * FROM records";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "Column 1: " . $row["column1"] . ", Column 2: " . $row["column2"];
      }
  } else {
      echo "No records found";
  }

  // Close the connection
  $conn->close();
  ?>
