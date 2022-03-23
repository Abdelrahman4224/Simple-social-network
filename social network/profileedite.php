<?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Edit</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">

<form name = "register" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?> "  autocomplete="off" enctype="multipart/form-data" onSubmit ="return validat()" >
<div class="container" align="left">
            <h1>Edit Profile</h1>
            <p>Please fill in this form to edit your profile.</p>
            <hr/>
                 <p>  <label><b>First Name:</b></label>
				 <input type="text" placeholder="Enter First Name" id ="firstname" name ="firstname"> </p>
                  <p>  <label><b>Last Name:</b></label>
				 <input type="text" placeholder="Enter Last Name" id ="lastname" name ="lastname"> </p>
                 
                 <p>  <label><b>Password:</b></label>
				 <input type="password" placeholder="Enter Password" id ="password" name ="password"> </p>
                 <p>  <label><b>User Name:</b></label>
				 <input type="text" placeholder="Enter User Name" id ="username" name ="username"> </p>
                 <p>  <label><b>PhoneNumber:</b></label>
				 <input type="text" id ="PhoneNumber" name="PhoneNumber"  placeholder="123-456-789" pattern="[0-9]{4}[0-9]{3}[0-9]{4}"> </p>
                 <p>  <label><b>Birthdate:</b></label>
				 <input type="date"  id ="Birthdate" name="Birthdate"> </p>
                 <p>  <label><b>Hometown:</b></label>
				 <input type="text" placeholder="Enter Hometown" id ="Hometown" name ="Hometown"> </p>
                 
                 <p>  <label><b>Maritalstatus:</b><label>
                 <input type="radio"  id ="maritalstatus" name="maritalstatus" value="Single">        
                 <label for="Single">Single</label><br>
                 &emsp;&emsp;&emsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="radio" id ="maritalstatus" name="maritalstatus" value="Engaged">
                 <label for="Engaged">Engaged</label><br>
				 &emsp;&emsp;&emsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="radio" id ="maritalstatus" name="maritalstatus" value="Married">
                 <label for="Married">Married</label> </p>
                 <p>  <label><b>Profilepicture:</b><label>
                 <input type="file" name="Profilepicture" id="Profilepicture" > </p>

                 <div align="center">
                <button type="submit" name="enter" class="loginbtn" value = "register" >Done</button>
                <button type="button" name="cancel" class="cancelbtn">Back</button>
            </div>

        </div>

</form>



<?php

   

	if ($_SERVER["REQUEST_METHOD"] == "POST" ){
 	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email=$_SESSION["user"];
    $password = $_POST['password'];
	$username = $_POST['username'];
	$PhoneNumber = $_POST['PhoneNumber'];
	$Gender = $_POST['gender'];
	$Birthdate = $_POST['Birthdate'];
	$Hometown = $_POST['Hometown'];
	$Maritalstatus = $_POST['maritalstatus'];
	$Profilepicture = $_POST['Profilepicture'];
	$ppurl ="";
  
   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $rand_dir_name = substr(str_shuffle($chars), 0, 15);
   mkdir("userdata/user_photos/$rand_dir_name");


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


	
	
	
	

$query = mysqli_query ($conn,"SELECT * FROM user WHERE email='$email'");
if(mysqli_num_rows($query)>0){
	$result = mysqli_fetch_object($query);
	$userid=$result->user_id;
	
	
}


if(@$_FILES["Profilepicture"]["tmp_name"] != null ) {
	
	
	move_uploaded_file(@$_FILES["Profilepicture"]["tmp_name"],"userdata/user_photos/$rand_dir_name/".$_FILES["Profilepicture"]["name"]);
    $profile_pic_name = @$_FILES["Profilepicture"]["name"];
    $ppurl = "http://localhost/v5/userdata/user_photos/$rand_dir_name/$profile_pic_name";
	
	
	$sql = "UPDATE user SET username='$username', firstname='$firstname', lastname ='$lastname',password=md5('$password'), PhoneNumber='$PhoneNumber',Birthdate='$Birthdate', Hometown='$Hometown' , maritalstatus ='$Maritalstatus' ,Profilepicture ='$_FILES[Profilepicture]' ,ppurl='$ppurl'
    WHERE email='$_SESSION[user]'";
	$query1 = mysqli_query($conn,"INSERT INTO posts(user_id, user, email, post, caption, Image, ispublic, postername) VALUES ('$userid','$username','$email','','$username changed their profile picture','$ppurl',1,'New profile picture')");
 
   
 }



else {
	
	$profile_pic_name = "";
    $ppurl = "";
	
	
	$sql = "UPDATE user SET  username='$username', firstname='$firstname', lastname ='$lastname',password=md5('$password'), PhoneNumber='$PhoneNumber',Birthdate='$Birthdate', Hometown='$Hometown' , maritalstatus ='$Maritalstatus' 
    WHERE email='$_SESSION[user]'";
	
	
}





if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	header("Location: http://localhost/v5/welcome.php?email=$email");
} else {
	
	error_reporting(E_ERROR | E_PARSE);
    
}

$conn->close();



	}






?>


<script>
function validat(){
	
	
	var firstname = document.getElementById("firstname");
	var lastname = document.getElementById("lastname");
	var username = document.getElementById("username");
	var email = document.getElementById("email");
    var password = document.getElementById("password");
	var Phonenumber = document.getElementById("PhoneNumber");
	var genders = document.getElementsByName("gender");
	var Birthdate = document.getElementById("Birthdate");
	var Hometown = document.getElementById("Hometown");
	var maritalstatus = document.getElementsByName("maritalstatus");
	//var Profilepicture = document.getElementsByName("Profilepicture");
	//var formData = new FormData();
    var t = document.getElementById("Profilepicture").files[0];
 
    //formData.append("Filedata", file);
    //var t = file.type.split('/').pop().toLowerCase();
	
	
	
    //if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
      //  alert('Please select a valid image file');
      //  document.getElementById("img").value = '';
     //   return false;
   // }
   // if (file.size > 1024000) {
      //  alert('Max Upload size is 1MB only');
      //  document.getElementById("img").value = '';
       // return false;
  //  }
    
	
	
	
	
	
	

if (password.value !="" && firstname.value !="" && lastname.value !="" && username.value !="" && Phonenumber.value !="" && Birthdate.value !="" && Hometown.value !="" ){
	
	
	if (maritalstatus[0].checked == false && maritalstatus[1].checked == false && maritalstatus[2].checked == false ) {
                   
				   alert("Please choose a Maritalstatus");
		           return false;
				   
	}
	
	
	

  
  
  
 
	
	
			
	
	
}
	
	
	
	
	
	
	else {
		alert("Please fill all data");
		return false;
	}
	
	
	
	
	
}
 

</script>


</body>
</html> 