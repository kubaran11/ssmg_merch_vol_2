 <?php
$servername = "localhost";
$username = "eshop";
$password = "eshop987";
$dbname = "eshop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn,"SET NAMES utf8");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

?>

