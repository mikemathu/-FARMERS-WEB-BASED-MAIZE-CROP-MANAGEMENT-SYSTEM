<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
	$username="";
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: offerDetailsInfo.php");
	// header("location: offerDetails.php");
}
if(isset($_POST["jid2"])){
    $_SESSION["offer_id"]=$_POST["jid2"];
    // header("location: offerDetailsInfo2.php?id= echo ' hi there';");
	header("location: offerDetailsInfo3.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewClient.php");
}


$sql = "SELECT * FROM farmer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $contactNo=$row["contact_no"];
        $gender=$row["gender"];
        $id_card_no=$row["id_card_no"];
        $farm_location=$row["farm_location"];
        $farm_size=$row["farm_size"];
        $soil_type=$row["soil_type"];
        }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM farm_output WHERE e_username='$username' and valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);



include('includes/header.php');

include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<img src="<?php echo (!empty($photo)) ? 'image/'.$photo : 'image/profile.jpg'; ?>" width="100%">
			
			<h2><?php //echo $name; ?></h2>
			<p><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></p>
			<ul class="list-group">
				<a href="postFarmOutput.php" class="list-group-item list-group-item-info">Sell Your Maize Here</a>
				<a href="chatapp.php" class="list-group-item list-group-item-info">Chat</a>
                <div class="col-auto">
           
        </div>
	          	<a href="editFarmer.php" class="list-group-item list-group-item-info">Edit Profile</a>
			  	<a href="message.php" class="list-group-item list-group-item-info">Messages</a>
			  	<a href="logout.php" class="list-group-item list-group-item-info">Logout</a>
	        </ul>
	    </div>
<!--End Main profile card-->

<!--Contact Information-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h4>About</h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Contact</div>
			  <div class="panel-body"><?php echo $contactNo; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">ID Card No</div>
			  <div class="panel-body"><?php echo $id_card_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Farm Location</div>
			  <div class="panel-body"><?php echo $farm_location; ?></div>
			</div>
      <div class="panel panel-success">
			  <div class="panel-heading">Farm Size</div>
			  <div class="panel-body"><?php echo $farm_size .' (ha)'; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Soil Type</div>
			  <div class="panel-body"><?php echo $soil_type; ?></div>
			</div>
		
		</div>
<!--End Contact Information-->

	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-info">
			  <div class="panel-heading"><h3>Farmer Profile Details</h3></div>
			</div>


			<?php	if(!empty($company)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Company</div>
					<h4> <?php // echo $company; ?> </h4>
					<div class="panel-body"><h4><?php echo $company; ?></h4></div>
				</div>
			<?php }?>

			<?php	if(!empty($profile_sum)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Profile Summery</div>
					<h4> <?php // echo $company; ?> </h4>
					<div class="panel-body"><h4><?php echo $profile_sum; ?></h4></div>
				</div>
			<?php }?>

			
			<div class="panel panel-primary">
			  <div class="panel-heading">Maize in the market ready for sell.</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
                                //    <td> <a class="btn btn-link btn-lg" href="offerDetailsInfo2.php?id='.$offer_id.'">'.$title.'</a></td>

                      
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["offer_id"];
                                $title=$row["title"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="farmerProfile.php" method="post">
                                <input type="hidden" name="jid2" value="'.$offer_id.'">
                                    <tr>
                                    <td>'.$offer_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'" ></td>
                                   
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr><td>N/A</td></tr>";
                        }

                       ?>
                  </table>
              </h4></div>
			</div>

      <div class="panel panel-primary">
			  <div class="panel-heading">Accepted Bids & Sold Maize Deals </div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
                      	$sql = "SELECT * FROM farm_output WHERE e_username='$username' and valid=0 ORDER BY timestamp DESC";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["offer_id"];
                                $title=$row["title"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="farmerProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$offer_id.'">
                                    <tr>
                                    <td>'.$offer_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr><td>N/A</td></tr>";
                        }

                       ?>
                  </table>
              </h4></div>
			</div>

	</div>
<!--End Column 2-->

<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
            <div class="panel panel-info">
			  <div class="panel-heading"><h3>Maize Offer Details Details</h3></div>
			</div>


			<div class="panel panel-primary">
			  <div class="panel-heading">Previous crop Offers Deals</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
                      	$sql = "select * from `market_request` left join `accepted` on accepted.offer_id=market_request.id where accepted.e_username='$username'";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["offer_id"];
                                $title=$row["title"];

                                echo '
                                <form action="farmerProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$offer_id.'">
                                    <tr>
                                    <td>'.$offer_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr><td>N/A</td></tr>";
                        }

                       ?>
                  </table>
              </h4></div>
			</div>		

	</div>

<!--Column 3-->


<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
            <div class="panel panel-info">
			  <div class="panel-heading"><h3>Farm Inputs</h3></div>
			</div>

            <div class="panel panel-primary">
			  <div class="panel-heading">Bought Farm Inputs</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Item Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
                      	$sql = "select * from `farm_input` left join `selected_farminput` on selected_farminput.offer_id=farm_input.item_id where selected_farminput.f_username='$username'";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["item_id"];
                                $title=$row["title"];

                                echo '
                                <form action="farmerProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$offer_id.'">
                                    <tr>
                                    <td>'.$offer_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr><td>N/A</td></tr>";
                        }

                       ?>
                  </table>
              </h4></div>
			</div>
		



			

	</div>
<!--End Social Network Profiles-->

	</div>
<!--End Column 3-->

</div>
</div>
<!--End main body-->

<?php include('includes/footer.php') ?>
