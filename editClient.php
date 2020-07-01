<?php include('inludes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}

$sql = "SELECT * FROM employer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name=$row["Name"];
        $email=$row["email"];
        $contactNo=$row["contact_no"];
        $gender=$row["gender"];
        $birthdate=$row["birthdate"];
        $address=$row["address"];
        $profile_sum=$row["profile_sum"];
        $company=$row["company"];
        $photo=$row["photo"];
        }
} else {
    echo "0 results";
}


if(isset($_POST["editEmployer"])){
    $name=test_input($_POST["name"]);
    $email=test_input($_POST["email"]);
    $contactNo=test_input($_POST["contactNo"]);
    $gender=test_input($_POST["gender"]);
    $birthdate=test_input($_POST["birthdate"]);
    $address=test_input($_POST["address"]);
    $profile_sum=test_input($_POST["profile_sum"]);
    $company=test_input($_POST["company"]);
    $photo=test_input($_POST["photo"]);


    $sql = "UPDATE employer SET Name='$name',email='$email',contact_no='$contactNo', address='$address', gender='$gender', profile_sum='$profile_sum', birthdate='$birthdate', company='$company', photo='$photo' WHERE username='$username'";

    
    $result = $conn->query($sql);
    if($result==true){
        header("location: employerProfile.php");
    }
}

include('includes/header.php');

include('includes/dashboard-navbar.php');

 ?>




<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Edit Profile</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-4 control-label">Choose photo</label>
                        <div class="col-sm-5">
                        <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Email address</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact no.</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="contactNo" value="<?php echo $contactNo; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" 
                                <?php if (isset($gender) && $gender=="male") echo "checked";?>
                                 value="male" /> Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" 
                                <?php if (isset($gender) && $gender=="female") echo "checked";?>
                                 value="female" /> Female
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" 
                                <?php if (isset($gender) && $gender=="other") echo "checked";?>
                                 value="other" /> Other
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Date of birth</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="birthdate" placeholder="YYYY/MM/DD" value="<?php echo $birthdate; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Company Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="company" value="<?php echo $company; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Profile Summery</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="profile_sum" value="<?php echo $profile_sum; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="editEmployer" class="btn btn-info btn-lg">Save changes</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/index.php')?>



