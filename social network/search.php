 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Users</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF'];?> " method="post" >
<div class="container" align="left">
<h1>Search For Users</h1>
            <p>Enter User Name or Email or PhoneNumber or Hometown..</p>
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
	
	echo '<IMG SRC="',$row['ppurl'],'" WIDTH="50" HEIGHT="50" BORDER="1" ALT="" />';
	echo "<br>username:".$row['firstname']." ".$row['lastname'];
	echo "<br>email:".$row['email'];
	echo "<br><br><br>";
	
	
}
}
else{
	echo "user does not exist" ;
	
	
}





}

?>


</body>
</html> 