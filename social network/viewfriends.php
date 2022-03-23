 <?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friends</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<div class="container" align="left">
<h1>Friends</h1>
            <p>Your Friends List..</p>
            <hr/>
		</div>
 <?php

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";
$email=$_SESSION["user"];


// Create connection
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = mysqli_query ($conn,"SELECT * FROM friends WHERE user_email='$email'");


if(mysqli_num_rows($query)>0){
	
while($row=mysqli_fetch_array($query)){
	$query1 = mysqli_query ($conn,"SELECT * FROM user WHERE email='$row[friend_email]'");
	if(mysqli_num_rows($query1)>0){
while($row1=mysqli_fetch_array($query1)){
	
	echo '<IMG SRC="',$row1['ppurl'],'" WIDTH="268" HEIGHT="268" BORDER="0" ALT="" />';
	echo "  ";
    echo "<br><a href=http://localhost/v5/profile.php?user=$row1[email]>$row1[firstname] $row1[lastname]</a>";
	echo "<br>";
	echo "<br>";
	
	
}}}
	
	
	
	
	
	
}




















?>

</body>
</html> 