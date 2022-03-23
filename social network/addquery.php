 <?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php


$email = $_GET['email'];
$friend = $_GET['friend'];

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);

// Check connection
if (!$conn) {
    echo "Connection failed ";
} 

$sql = "INSERT INTO friends (user_email, friend_email) VALUES ('$email', '$friend')";
$sql2 = "INSERT INTO friends (user_email, friend_email) VALUES ('$friend','$email')";



if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
	
	echo "<script>
alert('friend request sent');
window.location.href=' http://localhost/v5/welcome.php?email=$email';
</script>";
	
	
	
} else {
	
	error_reporting(E_ERROR | E_PARSE);
    
}

$conn->close();



	






?>
</body>
</html> 