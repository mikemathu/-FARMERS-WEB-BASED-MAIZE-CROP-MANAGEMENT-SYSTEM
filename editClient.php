<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

$sql = "SELECT * FROM clients WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name=$row["username"];
        $id_card_no=$row["id_card_no"];
        $contactNo=$row["contact_no"];
        $location=$row["location"];
        }
} 

if(isset($_POST["editclient"])){
    $name=test_input($_POST["username"]);
    $id_card_no=test_input($_POST["id_card_no"]);
    $contactNo=test_input($_POST["contact_no"]);
    $location=test_input($_POST["location"]);
    // $photo=test_input($_POST["photo"]);

    $sql = "UPDATE clients SET username='$name',contact_no='$contactNo', id_card_no='$id_card_no', location='$location' WHERE username='$username'";

    $result = $conn->query($sql);
    if($result==true){
        header("location: clientProfile.php");
    }
}

include('includes/header.php');

include('includes/client-navbar.php');
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
                        <input type="number" min="1"  class="form-control" name="contact_no" value="<?php echo $contactNo; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">ID Card no.</label>
                    <div class="col-sm-5">
                        <input type="number" min="1" class="form-control" name="id_card_no" value="<?php echo $id_card_no; ?>" />
                    </div>
                </div>        

               

                <div class="form-group">
                    <label class="col-sm-4 control-label">Location</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="location" value="<?php echo $location; ?>" />
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



