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
	$usertype="farmer";


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

include('includes/header.php');

include('includes/loginReg-navbar.php');


 ?>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
    <div class="page-header">
        <h2>Farmer Registration</h2>
    </div>

    <form id="registrationForm" method="post" class="form-horizontal">
        <div style="color:red;">
            <p><?php echo $errorMsg2; ?></p>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Username</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Retype Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" name="repassword" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Contact no.</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="contactNo" value="<?php echo $contactNo; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">ID Card no.</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="IdCardNo" value="<?php echo $IdCardNo; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Farm Location</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="farm_location" value="<?php echo $farm_location; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Farm Size in hectare(ha)</label>
            <div class="col-sm-5">

                <select  name="farm_size" class="form-control" id="doctor" required="required">
                    <option value="<?php echo $farm_size; ?>" disabled selected>Select Farm Size in hectare(ha)</option>                
                    <option value="<0.5">Less than 1/2 ha</option>
                    <option value="0.5">1/2 ha</option>
                    <option value="1">1 ha</option>
                    <option value="2">2 ha</option>
                    <option value="3">3 ha</option>
                    <option value="4">4 ha</option>
                    <option value="5">5 ha</option>
                    <option value=">5">More than 5 ha</option>
                </select>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Farm Soil Type</label>
            <div class="col-sm-5">

                <select name="soil_type" class="form-control" id="doctor" required="required">
                    <option value="<?php echo $soil_type; ?>" disabled selected>Select Soil Type in your Farm</option>                
                    <option value="Not Yet Tested">Not Yet Tested</option>
                    <option value="Sand">Sand</option>
                    <option value="clay">clay</option>
                    <option value="loam">loam</option>
                    <option value="sandy-clay">sandy-clay</option>
                    <option value="sandy-loam">sandy-loam</option>
                    <option value="silty-clay">silty-clay</option>
                    <option value="other">Other</option>
                </select>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Gender</label>
            <div class="col-sm-5">
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="male" /> Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="female" /> Female
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="other" /> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                <button type="submit" name="register" class="btn btn-info btn-lg">Sign up</button>
            </div>
        </div>
    </form>
</div>
    </div>
</div>






<?php include('includes/footer.php'); ?>





