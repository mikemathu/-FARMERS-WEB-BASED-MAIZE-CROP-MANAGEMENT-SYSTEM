<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}

$sql = "SELECT * FROM farmer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $username=$row["username"];
        $contactNo=$row["contact_no"];
        $IdCardNo=$row["id_card_no"];
        $farm_location=$row["farm_location"];
        $farm_size=$row["farm_size"];
        $soil_type=$row["soil_type"];
        }
} 

if(isset($_POST["editclient"])){
    $name=test_input($_POST["username"]);
    $contactNo=test_input($_POST["contactNo"]);
    $IdCardNo=test_input($_POST["IdCardNo"]);
    $farm_location=test_input($_POST["farm_location"]);
    $farm_size=test_input($_POST["farm_size"]);
    $soil_type=test_input($_POST["soil_type"]);

    $sql = "UPDATE farmer SET username='$name',contact_no='$contactNo', id_card_no='$IdCardNo', farm_location='$farm_location', farm_size='$farm_size', soil_type='$soil_type' WHERE username='$username'";
    
    $result = $conn->query($sql);
    if($result==true){
        header("location: farmerProfile2.php");
    }
}

include('includes/header.php');

include('includes/farmer-navbar.php');

 ?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Edit Profile</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Choose photo</label>
                        <div class="col-sm-5">
                        <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact no.</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" min="1" name="contactNo" value="<?php echo $contactNo; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">ID Card No</label>
                    <div class="col-sm-5">
                        <input type="number" min="1" class="form-control" name="IdCardNo" value="<?php echo $IdCardNo; ?>" />
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
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="editclient" class="btn btn-info btn-lg">Save changes</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

<?php include('includes/footer.php')?>



