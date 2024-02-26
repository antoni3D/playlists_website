 <?php
$servername = "spotify_generator";
$username = "admin";
$password = "";

// Połączenie
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 