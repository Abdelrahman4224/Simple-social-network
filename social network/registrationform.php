<?php
// Start the session
session_start();
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="registrationform.css">

</head>
<body>
<div align="center">

<form name = "register" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?> "  autocomplete="off" enctype="multipart/form-data" onSubmit ="return validat()">
<div class="container" align="left">
            <h1>Register</h1>
            <p>Please fill in this form to connect.</p>
            <hr/>
                 <p>  <label><b>First Name:</b></label>
				 <input type="text" placeholder="Enter First Name" id ="firstname" name ="firstname"> </p>
                  <p>  <label><b>Last Name:</b></label>
				 <input type="text" placeholder="Enter Last Name" id ="lastname" name ="lastname"> </p>
                 <p>  <label><b>Email:</b></label>
				 <input type="text" placeholder="Enter Email" id ="email" name ="email"> </p>
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
                 <p>  <label><b>Gender:</b><label>
                 <input type="radio" id="gender" name="gender" value="Male">
                              <label for="male">Male</label>
							  <input type="radio" id="gender" name="gender" value="Female">
                              <label for="female">Female</label> </p>
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
                <button type="submit" name="enter" class="loginbtn" value = "register" >Register</button>
                <button type="button" name="cancel" class="cancelbtn">Cancel</button>
            </div>

        </div>

</form>

<?php



	if (isset($_POST['enter'])){
 	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$username = $_POST['username'];
	$PhoneNumber = $_POST['PhoneNumber'];
	$Gender = $_POST['gender'];
	$Birthdate = $_POST['Birthdate'];
	$Hometown = $_POST['Hometown'];
	$Maritalstatus = $_POST['maritalstatus'];
	$Profilepicture = $_POST['Profilepicture'];
	$ppurl ="";
	$_SESSION["user"] = $email;
  
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

$query = mysqli_query ($conn,"SELECT * FROM user WHERE email='$email' AND password ='$password'");
if(mysqli_num_rows($query)>0){
	echo "email already exists ";
	error_reporting(E_ERROR | E_PARSE);
	
}

if(@$_FILES["Profilepicture"]["tmp_name"] == null && $Gender == Male) {
	
	$Profilepicture = 'http://localhost/v5/male.jpg' ;
	$ppurl = 'http://localhost/v5/male.jpg';
	
	$sql = "INSERT INTO user (email, username, firstname, lastname, password, PhoneNumber ,Birthdate, Hometown , gender , maritalstatus ,Profilepicture,ppurl)
VALUES ('$email', '$username', '$firstname','$lastname',md5('$password'),'$PhoneNumber','$Birthdate','$Hometown','$Gender','$Maritalstatus','$Profilepicture','$ppurl')";
}

else if(@$_FILES["Profilepicture"]["tmp_name"] == null && $Gender == Female) {
	
	$Profilepicture = 'http://localhost/v5/female.jpg' ;
	$ppurl = 'http://localhost/v5/female.jpg';
	
	$sql = "INSERT INTO user (email, username, firstname, lastname, password, PhoneNumber ,Birthdate, Hometown , gender , maritalstatus ,Profilepicture,ppurl)
VALUES ('$email', '$username', '$firstname','$lastname',md5('$password'),'$PhoneNumber','$Birthdate','$Hometown','$Gender','$Maritalstatus','$Profilepicture','$ppurl')";
}

else {
	
	move_uploaded_file(@$_FILES["Profilepicture"]["tmp_name"],"userdata/user_photos/$rand_dir_name/".$_FILES["Profilepicture"]["name"]);
    $profile_pic_name = @$_FILES["Profilepicture"]["name"];
    $ppurl = "http://localhost/v5/userdata/user_photos/$rand_dir_name/$profile_pic_name";
	
	$sql = "INSERT INTO user (email, username, firstname, lastname, password, PhoneNumber ,Birthdate, Hometown , gender , maritalstatus ,Profilepicture ,ppurl)
VALUES ('$email', '$username', '$firstname','$lastname',md5('$password') ,'$PhoneNumber','$Birthdate','$Hometown','$Gender','$Maritalstatus','$_FILES[Profilepicture]','$ppurl')";
	
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
    
	
	
	
	
	
	

if (email.value !="" && password.value !="" && firstname.value !="" && lastname.value !="" && username.value !="" && Phonenumber.value !="" && Birthdate.value !="" && Hometown.value !="" ){
	if (genders[0].checked == false && genders[1].checked == false ) {
                   
				   alert("Please choose a gender");
		           return false;
				   
	}
	
	if (maritalstatus[0].checked == false && maritalstatus[1].checked == false && maritalstatus[2].checked == false ) {
                   
				   alert("Please choose a Maritalstatus");
		           return false;
				   
	}
	
	
	
	
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
		return true;
		
	}
  else {
	  alert("Please enter a valid email adress");
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