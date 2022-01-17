<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

if(isset($_SESSION["offer_id"])){
    $offer_id=$_SESSION["offer_id"];
}
else{
    $offer_id="";
}


// $sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$sql = "SELECT * FROM market_request WHERE id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title=$row["title"];
        $description=$row["description"];
        $budget=$row["budget"];
        $location=$row["location"];
        }
} else {
    echo "0 results";
}


if(isset($_POST["editJob"])){
    $title=test_input($_POST["title"]);
    $description=test_input($_POST["description"]);
    $budget=test_input($_POST["budget"]);

    $title=test_input($_POST["title"]);
    $maize_type=test_input($_POST["maize_type"]);
    $description=test_input($_POST["description"]);
    $number_of_bags=test_input($_POST["number_of_bags"]);
    $selling_price=test_input($_POST["selling_price"]);
    $location=test_input($_POST["location"]);

    // $sql = "UPDATE farm_output SET title='$title', maize_type='$maize_type',title='$title', description='$description', number_of_bags='$number_of_bags', selling_price='$selling_price', location='$location',e_username='$username', valid=1 WHERE offer_id='$offer_id'";
    $sql = "UPDATE market_request SET title='$title', description='$description', number_of_bags='$number_of_bags', budget='$selling_price', location='$location',e_username='$username', valid=1 WHERE id='$offer_id'";

    $result = $conn->query($sql);
    if($result==true){
        // header("location: offerDetails.php");
        header("location: marketRequest.php");
    }
}

include('includes/header.php');

include('includes/farmer-navbar.php');


 ?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Edit Job Offer</h2>
                </div>

            <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-5">
                        <input placeholder="Give your offer a title" type="text" class="form-control" name="title" value="<?php echo $title; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Maize Type</label>
                    <div class="col-sm-5">
                        <select name="maize_type" class="form-control" id="" required="required">
                                <option value="<?php echo $maize_type; ?>" disabled selected>Select Maize Type</option>                
                                <option value="White">White Maize</option>
                                <option value="Yellow">Yellow Maize</option>
                                <option value="Red">Red Maize</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Description <br>
                    <small disabled>(Optional)</small> </label>
                    
                    <div class="col-sm-5">
                        <input placeholder="Description" type="text" class="form-control" name="description" value="<?php echo $description; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Number Bags</label>
                    <div class="col-sm-5">
                        <input placeholder="Number of Bag" type="number" min="1" max="10000" class="form-control" name="number_of_bags" value="<?php echo $number_of_bags; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Selling Price per Bag</label>
                    <div class="col-sm-5">
                        <input placeholder="Price" type="number" class="form-control" name="selling_price" value="<?php echo $selling_price; ?>" />
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
                        <button type="submit" name="editJob" class="btn btn-info btn-lg">Edit</button>

                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>
