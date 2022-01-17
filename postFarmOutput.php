<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

$title=$maize_type=$description=$number_of_bags=$selling_price=$location="";

if(isset($_POST["postOffer"])){
    $title=test_input($_POST["title"]);
    $maize_type=test_input($_POST["maize_type"]);
    $description=test_input($_POST["description"]);
    $number_of_bags=test_input($_POST["number_of_bags"]);
    $selling_price=test_input($_POST["selling_price"]);
    $location=test_input($_POST["location"]);

    $sql = "INSERT INTO farm_output (maize_type,title, description,number_of_bags, selling_price, location,e_username, valid) VALUES ('$maize_type','$title', '$description','$number_of_bags','$selling_price','$location', '$username',1)";
    
    $result = $conn->query($sql);
    if($result==true){
        $_SESSION["offer_id"] = $conn->insert_id;
        header("location: offerDetails.php");
    } else {
        echo 'nothing';
    }
}

include('includes/header.php');

include('includes/farmer-navbar.php');


 ?>




<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Post Here to Sell Your Maize</h2>
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
                        <input placeholder="Price" type="number" class="form-control" min="1" name="selling_price" value="<?php echo $selling_price; ?>" />
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
                        <button type="submit" name="postOffer" class="btn btn-info btn-lg">Post</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>
