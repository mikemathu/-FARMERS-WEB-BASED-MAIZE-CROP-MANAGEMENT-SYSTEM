<?php
session_start();
// Create connection
$conn = new mysqli("localhost", "root", "", "fmarket");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$username=$password=$contactNo=$IdCardNo=$farm_location=$farm_size=$soil_type="";

if(isset($_POST["register"])){
	$username=test_input($_POST["username"]);
	$password=test_input($_POST["password"]);
	$repassword=test_input($_POST["repassword"]);
	$contactNo=test_input($_POST["contactNo"]);
	$IdCardNo=test_input($_POST["IdCardNo"]);
	$farm_location=test_input($_POST["farm_location"]);
	$farm_size=test_input($_POST["farm_size"]);
	$soil_type=test_input($_POST["soil_type"]);
	$gender=test_input($_POST["gender"]);
	// $usertype=test_input($_POST["usertype"]);
	$usertype="client";

	if ($usertype=="farmer") {
		$sql = "SELECT * FROM farmer,clients WHERE farmer.username = '$username' OR clients.username = '$username'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$_SESSION["errorMsg2"]="The username is already taken";
		}
		else{
			unset($_SESSION["errorMsg2"]);
			$sql = "INSERT INTO farmer (username, password, contact_no,id_card_no,farm_location,farm_size, soil_type, gender) VALUES ('$username', '$password','$contactNo','$IdCardNo', '$farm_location','$farm_size','$soil_type','$gender')";
			$result = $conn->query($sql);
			if($result==true){
				$_SESSION["Username"]=$username;
				$_SESSION["Usertype"]=1;
				header("location: farmerProfile.php");
			}

		}
	}
	else{
		$sql = "SELECT * FROM farmer,clients WHERE farmer.username = '$username' OR clients.username = '$username'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$_SESSION["errorMsg2"]="The username is already taken";
		}
		else{
			unset($_SESSION["errorMsg2"]);
			$sql = "INSERT INTO clients (username, password, contact_no,id_card_no,farm_location,farm_size, soil_type, gender) VALUES ('$username', '$password','$contactNo','$IdCardNo', '$farm_location','$farm_size','$soil_type','$gender')";
			$result = $conn->query($sql);
			if($result==true){
				$_SESSION["Username"]=$username;
				$_SESSION["Usertype"]=2;
				header("location: clientProfile.php");
				
			}

		}
	}
}

// Client Registration
if(isset($_POST["clientReg"])){
	$username=test_input($_POST["username"]);
	$password=test_input($_POST["password"]);
	$repassword=test_input($_POST["repassword"]);
	$contactNo=test_input($_POST["contactNo"]);
	$IdCardNo=test_input($_POST["IdCardNo"]);
	$location=test_input($_POST["location"]);
	$gender=test_input($_POST["gender"]);

		$sql = "SELECT * FROM farmer,clients WHERE farmer.username = '$username' OR clients.username = '$username'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$_SESSION["errorMsg2"]="The username is already taken";
		}
		else{
			unset($_SESSION["errorMsg2"]);
			$sql = "INSERT INTO clients (username, password, contact_no,id_card_no,location, gender) VALUES ('$username', '$password','$contactNo','$IdCardNo', '$location','$gender')";
			$result = $conn->query($sql);
			if($result==true){
				$_SESSION["Username"]=$username;
				$_SESSION["Usertype"]=2;
				header("location: clientProfile.php");				
			}
		}	
}

if(isset($_POST["login"])){
	session_unset();
	$username=test_input($_POST["username"]);
	$password=test_input($_POST["password"]);
	$usertype=test_input($_POST["usertype"]);

	if ($usertype=="farmer") {
		$sql = "SELECT * FROM clients WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		// if($result->num_rows === 0){

			
		if($result->num_rows == 0){

			// $_SESSION["errorMsg"]="username/password is incorrect";

			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=2;
			unset($_SESSION["errorMsg"]);
			header("location: farmerProfile2.php");
		}
		else{
			// $_SESSION["errorMsg"]="username/password is incorrect";
			$_SESSION["errorMsg"]="username/password is incorrect";

			// $_SESSION["Username"]=$username;
			// $_SESSION["Usertype"]=2;
			// unset($_SESSION["errorMsg"]);
			// header("location: farmerProfile2.php");
		}
	} 
	elseif ($usertype=="client") {
		$sql = "SELECT * FROM farmer WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		if($result->num_rows === 0){
		// if($result->num_rows !== 0){
		// if($result->num_rows > 0){
			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=1;
			unset($_SESSION["errorMsg"]);
			header("location: clientProfile.php");
		}
		else{
			$_SESSION["errorMsg"]="username/password is incorrect";
		}
	}
	else  {
		$_SESSION["errorMsg"]="User type not selected";
	}
	
	
}


if(isset($_SESSION["errorMsg"])){
	$errorMsg=$_SESSION["errorMsg"];
	unset($_SESSION["errorMsg"]);
}
else{
	$errorMsg="";
}

if(isset($_SESSION["errorMsg2"])){
	$errorMsg2=$_SESSION["errorMsg2"];
	unset($_SESSION["errorMsg2"]);
}
else{
	$errorMsg2="";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>