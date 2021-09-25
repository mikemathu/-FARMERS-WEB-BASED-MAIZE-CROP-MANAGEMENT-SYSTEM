<?php
session_start();


// Create connection
$conn = new mysqli("localhost", "root", "", "fmarket");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/*$sql = "SELECT * FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " " . $row["username"]. " " . $row["password"]. " " . $row["Name"]. "<br>";
    }
} else {
    echo "0 results";
}*/

// $username=$name=$email=$password=$contactNo=$birthdate=$address="";
$username=$password=$contactNo=$IdCardNo="";

// if(isset($_POST["register"])){
// 	$username=test_input($_POST["username"]);
// 	$name=test_input($_POST["name"]);
// 	$email=test_input($_POST["email"]);
// 	$password=test_input($_POST["password"]);
// 	$repassword=test_input($_POST["repassword"]);
// 	$contactNo=test_input($_POST["contactNo"]);
// 	$gender=test_input($_POST["gender"]);
// 	$birthdate=test_input($_POST["birthdate"]);
// 	$address=test_input($_POST["address"]);
// 	$usertype=test_input($_POST["usertype"]);

// 	if ($usertype=="artisan") {
// 		$sql = "SELECT * FROM artisan,client WHERE artisan.username = '$username' OR client.username = '$username'";
// 		$result = $conn->query($sql);
// 		if($result->num_rows > 0){
// 			$_SESSION["errorMsg2"]="The username is already taken";
// 		}
// 		else{
// 			unset($_SESSION["errorMsg2"]);
// 			$sql = "INSERT INTO artisan (username, password, Name, email, contact_no, address, gender, birthdate) VALUES ('$username', '$password', '$name','$email','$contactNo','$address','$gender','$birthdate')";
// 			$result = $conn->query($sql);
// 			if($result==true){
// 				$_SESSION["Username"]=$username;
// 				$_SESSION["Usertype"]=1;
// 				header("location: farmerProfile.php");
// 			}

// 		}
// 	}
// 	else{
// 		$sql = "SELECT * FROM artisan,client WHERE artisan.username = '$username' OR client.username = '$username'";
// 		$result = $conn->query($sql);
// 		if($result->num_rows > 0){
// 			$_SESSION["errorMsg2"]="The username is already taken";
// 		}
// 		else{
// 			unset($_SESSION["errorMsg2"]);
// 			$sql = "INSERT INTO client (username, password, Name, email, contact_no, address, gender, birthdate) VALUES ('$username', '$password', '$name','$email','$contactNo','$address','$gender','$birthdate')";
// 			$result = $conn->query($sql);
// 			if($result==true){
// 				$_SESSION["Username"]=$username;
// 				$_SESSION["Usertype"]=2;
// 				header("location: farmerProfile.php");
// 			}

// 		}
// 	}
// }

if(isset($_POST["login"])){
	session_unset();
	$username=test_input($_POST["username"]);
	$password=test_input($_POST["password"]);
	$usertype=test_input($_POST["usertype"]);

	if ($usertype=="farmer")
	 {
		// $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
		$sql = "SELECT * FROM farmer WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		// if($result->num_rows == 1){
		if($result->num_rows == 0){
			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=1;
			unset($_SESSION["errorMsg"]);
			header("location: farmerProfile.php");
			
		}
		else{
			$_SESSION["errorMsg"]="username/password is incorrect";
		}
	}
	else{
		$sql = "SELECT * FROM clients WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		if($result->num_rows == 1){
			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=2;
			unset($_SESSION["errorMsg"]);
			// header("location: farmerProfile.php");
			header("location: clientsProfile.php");
		}
		else{
			$_SESSION["errorMsg"]="username/password is incorrect";
		}
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

//$conn->close();
?>