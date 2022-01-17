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

$sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $available = $row["number_of_bags"];

    }}

if(isset($_POST["apply"]) && $msg==""){
    

    $cover=test_input($_POST["cover"]);
    $quantity=$_POST["quantity"];

    
    if ( $quantity <= $available ) {

        // $sql = "INSERT INTO apply (f_username, offer_id, bid, cover_letter,quantity) VALUES ('$username', '$offer_id', '$bid','$cover','$quantity')";
        $sql = "INSERT INTO apply (f_username, offer_id, cover_letter,quantity) VALUES ('$username', '$offer_id','$cover','$quantity')";
        $result = $conn->query($sql);
        if($result==true){
            header("location: farmOutput.php");
        }


    } else{
        echo "<script>alert('Your order exceeds what is in our stock')</script>";
    }




   
}
 
include('includes/header.php');

include('includes/client-navbar.php');

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

                <?php
                        $sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $quantity = $row["number_of_bags"];

                            }}
                            ?>

                        <div class="form-group">

                        <label class="col-sm-4 control-label">Available Quantity</label>
                        <!-- <input class="form-control" type="submit" name="available" value="<?php //echo $quantity; ?>"> -->
                        <div class="col-sm-8">
                            
                            <input class="form-control" type="number" name="available" value="<?php echo $quantity; ?>" disabled>


                        </div>
                        </div>
                           
                            
                        <div class="form-group">
                            
                            <label class="col-sm-4 control-label">Choose Quantity</label>
                            <div class="col-sm-8">
                                    

                                <input class="form-control" type="number" min="0" placeholder="Quantity" name="quantity" value="1">

                            </div>
                        </div>

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Place a bid</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="bid" value="" />
                    </div>
                </div> -->

                

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" onclick="alert('Bill  Paid Successfully')" name="apply" class="btn btn-info btn-lg">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


    <?php include('includes/footer.php');?>