 <?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friends Posts</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<div class="container" align="left">
<h1>Friends Posts</h1>
            <p>For More Posts -> Add Friends..</p>
            <hr/>
		</div>
<?php
$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";

// Create connection
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Select the rows name and age from employee
$sql = "SELECT * FROM friends where user_email='$_SESSION[user]'; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM posts where email='$row[friend_email]'; ";
        $result1 = $conn->query($sql1);
       if ($result1->num_rows > 0) {
    // output data of each row
	while($row1 = $result1->fetch_assoc()) {
        if ($row1['Image']==""){
		echo "<br>user:".$row1['user'];
	    echo "<br>post:".$row1['post'];
	    echo "<br>caption:".$row1['caption'];
	    echo "<br>posted time:".$row1['posted time'];
	    echo "<br>poster name:".$row1['postername'];
		echo "<br><br><br>";
    }
	else{
		echo "<br>user:".$row1['user'];
	    echo "<br>post:".$row1['post'];
	    echo "<br>caption:".$row1['caption'];
	    echo "<br><IMG SRC='$row1[Image]' WIDTH='268' HEIGHT='268' BORDER='0' />";
		echo "<br>posted time:".$row1['posted time'];
	    echo "<br>poster name:".$row1['postername'];
		echo "<br><br><br>";
		}
}
}}} 
else {
    echo "No friend Posts";
}
//$conn->close();
?>
</html>