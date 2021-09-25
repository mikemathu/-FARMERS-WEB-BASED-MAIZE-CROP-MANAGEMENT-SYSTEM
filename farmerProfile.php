<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
	$username="";
	//header("location: index.php");
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: offerDetails.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewClient.php");
}


// $sql = "SELECT * FROM client WHERE username='$username'";
$sql = "SELECT * FROM clients WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // $name=$row["Name"];
        // $email=$row["email"];
        $contactNo=$row["contact_no"];
        $gender=$row["gender"];
        $birthdate=$row["birthdate"];
        // $address=$row["address"];
        $profile_sum=$row["profile_sum"];
		$company=$row["company"];
		// $photo=$row["photo"];
        }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM farm_output WHERE e_username='$username' and valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);

include('includes/header.php');

include('includes/client-navbar.php');

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
	          	<a href="editFarmer.php" class="list-group-item list-group-item-info">Edit Profile</a>
			  	<a href="message.php" class="list-group-item list-group-item-info">Messages</a>
			  	<a href="logout.php" class="list-group-item list-group-item-info">Logout</a>
	        </ul>
	    </div>
<!--End Main profile card-->

<!--Contact Information-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h4>Contact Information</h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Email</div>
			  <div class="panel-body"><?php //echo $email; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Mobile</div>
			  <div class="panel-body"><?php echo $contactNo; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Address</div>
			  <div class="panel-body"><?php //echo $address; ?></div>
			</div>
		</div>
<!--End Contact Information-->



	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-primary">
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
			  <div class="panel-heading">Current Farm Output Offerings</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 
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

			<div class="panel panel-primary">
			  <div class="panel-heading">Ongoing deals Offerings</div>
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



			
			<div class="panel panel-primary">
			  <div class="panel-heading">Currently Hired Clients</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Client</td>
                      </tr>
                      <?php 
                      	$sql = "SELECT * FROM farm_output,selected WHERE farm_output.offer_id=selected.offer_id AND selected.e_username='$username' AND selected.valid=1 ORDER BY farm_output.timestamp DESC";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["offer_id"];
                                $title=$row["title"];
                                $f_username=$row["f_username"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="farmerProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$offer_id.'">
                                    <tr>
                                    <td>'.$offer_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    </form>
                                    <form action="farmerProfile.php" method="post">
                                    <input type="hidden" name="f_user" value="'.$f_username.'">
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
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


<!--Column 3-->
	<!-- <div class="col-lg-2">
My Wallet
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-info">
			  <div class="panel-heading"><h3>My Wallet</h3></div>
			</div>
			<ul class="list-group">
			  <li class="list-group-item">Balance: $0.0</li>
			  <li class="list-group-item">Payment Method: </li>
			  <li class="list-group-item">Deposit</li>
			</ul>
		</div> -->
<!--End My Wallet-->

<!--Social Network Profiles-->
		<!-- <div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-info">
			  <div class="panel-heading"><h3>Social Network Profiles</h3></div>
			</div>
			<ul class="list-group">
			  <li class="list-group-item" style="font-size:20px;color:#3B579D;"><i class="fab fa-facebook-square"> Facebook</i></li>
			  <li class="list-group-item" style="font-size:20px;color:#D34438;"><i class="fab fa-google-plus-square"> Google</i></li>
			  <li class="list-group-item" style="font-size:20px;color:#2CAAE1;"><i class="fab fa-twitter-square"> Twitter</i></li>
			  <li class="list-group-item" style="font-size:20px;color:#0274B3;"><i class="fab fa-linkedin"> Linkedin</i></li>
			</ul>
		</div> -->
<!--End Social Network Profiles-->

	</div>
<!--End Column 3-->

</div>
</div>
<!--End main body-->


<?php include('includes/footer.php') ?>

