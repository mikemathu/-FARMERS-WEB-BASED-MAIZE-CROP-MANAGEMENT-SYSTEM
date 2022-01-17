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

// Get ArtisanID
$artisanName = $_SESSION["Username"];

$checkArtisanID = mysqli_query
($conn, "SELECT * FROM farmer WHERE username= '$artisanName' ");

if(mysqli_num_rows($checkArtisanID) > 0){
    $row   = mysqli_fetch_row($checkArtisanID);

     $artisanId = $row[0];
   }

$sql = "SELECT * FROM apply WHERE offer_id='$offer_id' and f_username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $msg="You have already sent your bid for this offer. You cannot bid again.";
} else {
    $msg="";
}

if(isset($_POST["apply"]) && $msg==""){
    $cover=test_input($_POST["cover"]);
    $bid=test_input($_POST["bid"]);
    $sql = "INSERT INTO apply (f_username, offer_id, bid, cover_letter) VALUES ('$username', '$offer_id', '$bid','$cover')";
    $result = $conn->query($sql);
    if($result==true){
        header("location: farmOutput.php");
    }
}
 
include('includes/header.php');

include('includes/farmer-navbar.php');

 ?>


<div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Bid this Offer</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <?php echo $msg; ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Write A Message</label>

                    <div class="col-sm-8">
                        <textarea class="form-control" rows="17" name="cover"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Place a bid</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="bid" value="" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="apply" class="btn btn-info btn-lg">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


    <?php include('includes/footer.php');?>