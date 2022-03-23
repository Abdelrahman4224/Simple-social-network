 <?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<div class="container" align="left">
<h1>User Profile</h1>
            <p>To Discover User's News Add Him/Her ..</p>
            <hr/>
		</div>



<?php


    

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";
$user = $_GET['user'];
//$email=$_SESSION["user"];
// Create connection
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
$query = mysqli_query ($conn,"SELECT * FROM user WHERE email='$user'");


if(mysqli_num_rows($query)>0){
	$result = mysqli_fetch_object($query);
	$firstname = $result->firstname;
	$lastname = $result->lastname;
	$ppurl = $result->ppurl;
	$email = $result->email;
	$userid=$result->user_id;
	$username=$result->username;
	$gender=$result->gender;
	$hometown=$result->Hometown;
	$martialstatus=$result->maritalstatus;
	
echo '<br><IMG SRC="',$ppurl,'" WIDTH="268" HEIGHT="268" BORDER="1" ALT="" /><br><br>';
echo "$firstname $lastname's <br>PROFILE PICTURE<br>";
echo "<br>Gender: $gender <br>";
echo "<br>Lives in $hometown <br>";
echo "<br>MartialStatus: $martialstatus<br>";

echo "<br>";
echo "<br><button><a href=http://localhost/v5/addquery.php?email=$_SESSION[user]&friend=$email>Add Friend</a></button><br>";
	
	
	
}




		
	//$conn->close();	












?>
<div align="center">
<div class="container" align="center">
<h1><br>WALL</h1>
            <hr/>
		</div>



<?php


$query = mysqli_query ($conn,"SELECT * FROM posts WHERE email = '$user' AND ispublic = 1");

if(mysqli_num_rows($query)>0){
	
while($row=mysqli_fetch_array($query)){
	
	if($row['Image']==""){
		echo' <table style="width:100%">
  
  <br><br>POSTER NAME : <tr>',$row['postername'],'</tr><br>
  Caption : <tr>',$row['caption'],'</tr><br>
  <tr>',$row['post'],'</tr><br>
  POST Date : <tr>',$row['posted time'],'</tr>
    
  </table> ';
		
		
	}
	
	
	else{
		
		
		echo' <table style="width:100%">
  
  <br><br>POSTER NAME : <tr>',$row['postername'],'</tr><br>
  <tr><IMG SRC="',$row['Image'],'" WIDTH="268" HEIGHT="268" BORDER="0" ALT="" /></tr><br>
  Caption : <tr>',$row['caption'],'</tr><br>
  <tr>',$row['post'],'</tr><br>
  POST Date : <tr>',$row['posted time'],'</tr>
    
  </table> ';
		
	}
	
	
     
	
	
	
	
	
}

}
else {
	
   echo "<br>This Profile Is Private..";
	
	
}





?>
 






</body>
</html> 