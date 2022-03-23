 <?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Friends</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF'];?> " method="post" >
<div class="container" align="left">
<h1>Search For New Friends</h1>
            <p>Enter User Name or Email ..</p>
            <hr/>
			<p>  <label><b>Search:</b></label>
        <input type="text" placeholder="Search..." id ="search" name="search"  /> </p>
		<input type="submit" class="postbtn" name="button" value="Search"  />
		</div>
		</form>	







<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" ){

$word=$_POST['search'];


$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);


$query = mysqli_query ($conn,"SELECT * FROM user WHERE email like '%$word%' OR firstname like '%$word%' OR lastname like '%$word%' OR PhoneNumber like '%$word%' OR Hometown like '%$word%'");


if(mysqli_num_rows($query)>0){
while($row=mysqli_fetch_array($query)){
	
	
	if($_SESSION["user"] == $row['email'])
	{
	echo '<br><IMG SRC="',$row['ppurl'],'" WIDTH="268" HEIGHT="268" BORDER="1" ALT="" /><br><br>';
	echo "<br>email:".$row['email'];
	echo "<br>username:".$row['username'];
	}
	
	
	else {
		$query1 = mysqli_query ($conn,"SELECT * FROM friends WHERE user_email = '$_SESSION[user]' and friend_email = '$row[email]' ");
		if(mysqli_num_rows($query1)>0){
			echo '<br><IMG SRC="',$row['ppurl'],'" WIDTH="268" HEIGHT="268" BORDER="1" ALT="" /><br><br>';
			echo "<br>email:".$row['email'];
	        echo "<br>username:".$row['username'];
			echo "<br>you are already friends";
			
		}
		else{	
	echo '<br><IMG SRC="',$row['ppurl'],'" WIDTH="268" HEIGHT="268" BORDER="1" ALT="" /><br><br>';
	echo "<br>email:".$row['email'];
	echo "<br>username:".$row['username'];
	echo "<br><button><a href=http://localhost/v5/addquery.php?email=$_SESSION[user]&friend=$row[email]>Add Friend</a></button><br>";
	echo "<button><a href=http://localhost/v5/profilepublic.php?user=$row[email]>view profile</a></button><br>";
	echo "<br>";
	}
 
		
	}
	
	
	
}
}
else{
	echo "user does not exist" ;
	
	
}





}

?>


</body>
</html> 