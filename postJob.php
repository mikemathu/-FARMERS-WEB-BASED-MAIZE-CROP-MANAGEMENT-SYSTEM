<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}


if(isset($_POST["postJob"])){
    $title=test_input($_POST["title"]);
    $description=test_input($_POST["description"]);
    $budget=test_input($_POST["budget"]);
    $location=test_input($_POST["location"]);
    // $deadline=test_input($_POST["deadline"]);

    $sql = "INSERT INTO job_offer (title, description, budget, location, e_username, valid) VALUES ('$title', '$description','$budget','$location', '$username',1)";
    
    $result = $conn->query($sql);
    if($result==true){
        $_SESSION["job_id"] = $conn->insert_id;
        header("location: jobDetails.php");
    } else {
        echo 'nothing';
    }
}

include('includes/header.php');

// include('includes/dashboard-navbar.php');

include('includes/artisan-navbar.php');


 ?>




<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Post A Job Offer</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Job Title</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Job Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Budget</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="budget" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Your Location</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="location" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Deadline</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="deadline" value="" placeholder="YYYY-MM-DD" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="postJob" class="btn btn-info btn-lg">Post</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>



