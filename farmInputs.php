<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		$linkPro="farmerProfile.php";
		$linkEditPro="editArtisan.php";
		$linkBtn="bidOffer.php";
		$textBtn="Bid this Offer";
	}
	else{
		$linkPro="farmerProfile.php";
		$linkEditPro="editclient.php";
		$linkBtn="editFarmOutputOffer.php";
		$textBtn="Edit the Crop Offer";
	}
}
else{
    $username="";
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: farmInputDetails.php");
}

$sql = "SELECT * FROM farm_input WHERE valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$sql = "SELECT * FROM farm_input WHERE title='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["s_client"])){
	$t=$_POST["s_client"];
	$sql = "SELECT * FROM farm_input WHERE e_username='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["s_id"])){
	$t=$_POST["s_id"];
	$sql = "SELECT * FROM farm_input WHERE offer_id='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["recentJob"])){
	$sql = "SELECT * FROM farm_input WHERE valid=1 ORDER BY timestamp DESC";
	$result = $conn->query($sql);
}

if(isset($_POST["oldJob"])){
	$sql = "SELECT * FROM farm_input WHERE valid=1";
	$result = $conn->query($sql);
}

include('includes/header.php');

$userName =  $_SESSION['Username'];

include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Farm Inputs</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Type</td>
                          <!-- <td style="font-weight:bold; padding-bottom:10px;">Description</td> -->
                          <td style="font-weight:bold; padding-bottom:10px;">No. of<br> Bags</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Price</td>
                          <!-- <td style="font-weight:bold; padding-bottom:10px;">Farmer<br> Name</td> -->
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
								
                                $item_id=$row["item_id"];
								$title=$row["title"];
								$item_type=$row["item_type"];
								$quantity=$row["quantity"];
								$selling_price=$row["selling_price"];
                                $e_username=$row["e_username"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="farmInputs.php" method="post">
                                <input type="hidden" name="jid" value="'.$item_id.'">
                                    <tr>
                                    <td>'.$item_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$item_type.'</td>
                                    <td>'.$quantity.'</td>
                                    <td>'.$selling_price.'</td>
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr></tr><tr><td></td><td>Nothing to show</td></tr>";
                        }

                       ?>
                     </table>
              </h4></div>
			</div>
			<p></p>
		</div>
<!--End client Profile Details-->

	</div>
<!--End Column 1-->


<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>

	        <form action="farmInputs.php" method="post">
				<div class="form-group">
				  <center><button type="submit" name="recentJob" class="btn btn-warning">See all recent posted crops first</button></center>
				</div>
	        </form>

	        <form action="farmInputs.php" method="post">
				<div class="form-group">
				  <center><button type="submit" name="oldJob" class="btn btn-warning">See all older posted crops first</button></center>
				</div>
	        </form>

	        <p></p>
	    </div>
<!--End Main profile card-->

	</div>
<!--End Column 2-->

</div>
</div>
<!--End main body-->

<?php 

include('includes/footer.php');
?>


