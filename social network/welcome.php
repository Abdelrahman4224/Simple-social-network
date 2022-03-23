 <?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">
<h1>SOCIAL NETWORK</h1>


<?php


    

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";
//$email = $_GET['email'];
$email=$_SESSION["user"];
// Create connection
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
$query = mysqli_query ($conn,"SELECT * FROM user WHERE email='$email'");


if(mysqli_num_rows($query)>0){
	$result = mysqli_fetch_object($query);
	$firstname = $result->firstname;
	$ppurl = $result->ppurl;
	$email = $result->email;
	$userid=$result->user_id;
	$username=$result->username;
	
	
echo '<br><IMG SRC="',$ppurl,'" WIDTH="268" HEIGHT="268" BORDER="0" ALT="" /><br><br>';
echo "Welcome Back $firstname !";
	
	
}



		
	//$conn->close();	












?>



<script>





</script>

<form name = "userpost" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?> "  autocomplete="off" enctype="multipart/form-data" onSubmit ="return validat()">
<div class="container" align="left">
<h1>Home</h1>
            <p>Welcome to the Social Network.</p>
			<hr/>
            <p>  <label><b>Caption:</b></label>
			<input type="text" placeholder="Enter The Caption" id ="caption" name="caption"> </p>
            <p>  <label><b>PosterName:</b></label>
			<input type="text" placeholder="Enter PosterName" id ="postername" name="postername"> </p>
<input type="file" name="img" id="img" ><br>
<textarea id="userposts" class="text" cols="97" rows ="10" name="userposts" ></textarea><br>

&nbsp&nbsp<input type="radio" id="public" name="public" value="1">
                              <label for="public">Public</label>
       &emsp;&emsp;&emsp;&nbsp&nbsp&nbsp <input type="radio" id="public" name="public" value="0">
                              <label for="not public">Not Public</label>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp&nbsp&nbsp <input type = "submit" class="postbtn" name = "post" value = "post"><br><br><br>

</div>

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	$caption = $_POST['caption'];
	$postername = $_POST['postername'];
	//$img = $_POST['img'];
	$userposts = $_POST['userposts'];
	$public = $_POST['public'];
	

	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $rand_dir_name = substr(str_shuffle($chars), 0, 15);
   mkdir("userdata/user_posts/$rand_dir_name");
   
   if(@$_FILES["img"]["tmp_name"] == ""){
	   $ppurl='';
	   $query = mysqli_query($conn,"INSERT INTO posts(user_id, user, email, post, caption, Image, ispublic, postername) VALUES ('$userid','$username','$email','$userposts','$caption','$ppurl','$public','$postername')");
 
	   
   }
   else{
	   move_uploaded_file(@$_FILES["img"]["tmp_name"],"userdata/user_posts/$rand_dir_name/".$_FILES["img"]["name"]);
    $profile_pic_name = @$_FILES["img"]["name"];
    $ppurl = "http://localhost/v5/userdata/user_posts/$rand_dir_name/$profile_pic_name";
	
	
	$query = mysqli_query($conn,"INSERT INTO posts(user_id, user, email, post, caption, Image, ispublic, postername) VALUES ('$userid','$username','$email','$userposts','$caption','$ppurl','$public','$postername')");
 
   }
   
   
	
	
}

$query = mysqli_query ($conn,"SELECT * FROM posts WHERE email = '$email'");

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




?>
 <div align="center">
<br><br><br><br><br><br><br><br><br><a href="http://localhost/v5/friendsposts.php" class="btn1">Friends Posts</a>
<a href="http://localhost/v5/profileedite.php?email=<?php echo $email; ?>" class="btn2">Edit Profile</a></button>
<a href="http://localhost/v5/search.php" class="btn3">Find Users</a>
<a href="http://localhost/v5/searchpost.php" class="btn4">Find Posts</a>
<a href="http://localhost/v5/addfriends.php" class="btn5">Add Friends</a>
<a href="http://localhost/v5/viewfriends.php" class="btn6">View Friends</a>
<a href="http://localhost/v5/homepage.html" class="btn7">Logout</a><br><br>
<br>
</div>

        </div>




<script>
function validat(){
	
	
	var caption = document.getElementById("caption");
	var postername = document.getElementById("postername");
	var userposts = document.getElementById("userposts");
	var pub = document.getElementsByName("public");
	
 
	
	
	
	
	

if (caption.value !="" && postername.value !="" && userposts.value !=""){
	if (pub[0].checked == false && pub[1].checked == false ) {
                   
				   alert("Please choose post privacy");
		           return false;
				   
	}
	
	
	
	
	
	
	
 
  
  
  
 
	
	
			
	
	
}
	
	
	
	
	
	
	else {
		alert("Please fill all post data");
		return false;
	}
	
	
	
	
	
}
 

</script>


</body>
</html> 