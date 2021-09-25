<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_SESSION["offer_id"])){
    $offer_id=$_SESSION["offer_id"];
}
else{
    $offer_id="";
    //header("location: index.php");
}


$sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title=$row["title"];
        // $type=$row["type"];
        $description=$row["description"];
        $budget=$row["budget"];
        // $skills=$row["skills"];
        // $special_skill=$row["special_skill"];
        }
} else {
    echo "0 results";
}


if(isset($_POST["editJob"])){
    $title=test_input($_POST["title"]);
    // $type=test_input($_POST["type"]);
    $description=test_input($_POST["description"]);
    $budget=test_input($_POST["budget"]);
    // $skills=test_input($_POST["skills"]);
    // $special_skill=test_input($_POST["special_skill"]);


    $sql = "UPDATE farm_output SET title='$title',description='$description', budget='$budget', e_username='$username', valid=1 WHERE offer_id='$offer_id'";

    
    $result = $conn->query($sql);
    if($result==true){
        header("location: offerDetails.php");
    }
}

include('includes/header.php');

include('includes/client-navbar.php');


 ?>




<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Edit Job Offer</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Job Title</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Job Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Budget</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="budget" value="<?php echo $budget; ?>" />
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Your Location</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="location" value="<?php //echo $location; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Deadline</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="deadline" value="<?php //echo $description; ?>" placeholder="YYYY-MM-DD" />
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="editJob" class="btn btn-info btn-lg">Edit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>

