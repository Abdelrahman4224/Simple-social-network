 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Posts</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF'];?> " method="post" >
<div class="container" align="left">
<h1>Search For Posts</h1>
            <p>Enter The Caption Of Post..</p>
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


$query = mysqli_query ($conn,"SELECT * FROM posts WHERE post like '%$word%' OR caption like '%$word%' OR Image like '%$word%' OR postername like '%$word%'");

if(mysqli_num_rows($query)>0){
while($row=mysqli_fetch_array($query)){
	
	if($row['ispublic']==1){
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
		
	} }
	
	else{
	echo "Post does not exist" ;
	
	
}
	
	
}
}






}

?>


</body>
</html> 