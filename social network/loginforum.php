 <?php
// Start the session
session_start();
?>

 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="loginforum.css">

</head>
<body>
<div align="center">

<form method="post" action="loginforum.php">
        <div class="container" align="left">
            <h1>Login</h1>
            <p>Please fill in this form to connect.</p>
            <hr/>

            <p>  <label><b>Email:</b></label>
                <input type="text" placeholder="Enter Email" id="email" name="email" > </p>

            <p>  <label><b>Password:</b></label>
                <input type="password" placeholder="Enter Password" id="password" name="password" > </p>

            <div align="center">
                <button type="submit" name="login" class="loginbtn" value = "LOGIN" >Login</button>
                <button type="button" name="cancel" class="cancelbtn">Cancel</button>
            </div>

        </div>


</form>

<?php




if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	
		$email = $_POST['email'];
	    $password = $_POST['password'];
		$_SESSION["user"] = $email;
		
		
$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "registration";

// Create connection
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
$query = mysqli_query ($conn,"SELECT * FROM user WHERE email='$email' AND password =md5('$password')");
if(mysqli_num_rows($query)>0){
	$result = mysqli_fetch_object($query);
    $firstname = $result->firstname;
	header("Location: http://localhost/v5/welcome.php?email=$email");
	
}
else{
	echo "Email does not exist or wrong password ! " ; 
	echo "<br>";
	echo '<a href="http://localhost/v5/registrationform.php">Click here to register</a>';

	
	
}
		
	$conn->close();	
	    
}
	



?>

<script>
function validat(){
	var email = document.getElementById("email");
    var password = document.getElementById("password");

if (email.value !="" && password.value !=""){
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