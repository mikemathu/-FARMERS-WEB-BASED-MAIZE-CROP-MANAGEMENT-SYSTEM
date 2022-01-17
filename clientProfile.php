<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
	$username="";
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: marketRequestinfo.php");
}
if(isset($_POST["jid2"])){
	$_SESSION["offer_id"]=$_POST["jid2"];
	header("location: marketRequest.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewClient.php");
}


$sql = "SELECT * FROM clients WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name=$row["username"];
        $id_card_no=$row["id_card_no"];
        $contactNo=$row["contact_no"];
        $gender=$row["gender"];
        $location=$row["location"];
        }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM market_request WHERE e_username='$username' and valid=1 ORDER BY timestamp DESC";
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
			
			<h2><?php echo $name; ?></h2>
			<p><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></p>
			<ul class="list-group">
				<a href="postRequestToMarket.php" class="list-group-item list-group-item-info">Make Your Order </a>
	          	<a href="editclient.php" class="list-group-item list-group-item-info">Edit Profile</a>
			  	<a href="message2.php" class="list-group-item list-group-item-info">Messages</a>
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
			  <div class="panel-heading">Mobile</div>
			  <div class="panel-body"><?php echo $contactNo; ?></div>
			</div>
      <div class="panel panel-success">
			  <div class="panel-heading">ID Card No.</div>
			  <div class="panel-body"><?php echo $id_card_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Location</div>
			  <div class="panel-body"><?php echo $location; ?></div>
			</div>
		</div>
<!--End Contact Information-->



	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin:20px 0px 100px">
			<div class="panel panel-info">
			  <div class="panel-heading"><h3>Your Maize Orders Details</h3></div>
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
			  <div class="panel-heading">Active Farm Output Offers</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 

                        // $sql = "select * from market_request where e_username=$username";

                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["id"];
                                $title=$row["title"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="clientProfile.php" method="post">
                                <input type="hidden" name="jid2" value="'.$offer_id.'">
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
			  <div class="panel-heading">Previous Farm Output Offers</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted on</td>
                      </tr>
                      <?php 

                        // $sql = "select * from market_request where e_username=$username";
                        $sql = "SELECT * FROM market_request WHERE e_username='$username' and valid=0 ORDER BY timestamp DESC";
$result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["id"];
                                $title=$row["title"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="clientProfile.php" method="post">
                                <input type="hidden" name="jid2" value="'.$offer_id.'">
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
                      	$sql = "select * from `farm_output` left join `selected` on selected.offer_id=farm_output.offer_id where selected.e_username='$username' ORDER BY timestamp DESC";
                      	// $sql = "select * from `farm_output` left join `accepted` on accepted.offer_id=farm_output.offer_id where accepted.e_username='$username' ORDER BY timestamp DESC";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $offer_id=$row["offer_id"];
                                $title=$row["title"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="clientProfile.php" method="post">
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
		
			<!-- <div class="panel panel-primary">
			  <div class="panel-heading">Currently Hired artisans(Clients)</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Crop Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Farmer</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted On</td>
                      </tr>
                      <?php 
                    //   	$sql = "SELECT * FROM farm_output,selected WHERE farm_output.offer_id=selected.offer_id AND selected.e_username='$username' AND selected.valid=1 ORDER BY farm_output.timestamp DESC";
					// 	$result = $conn->query($sql);
                    //   if ($result->num_rows > 0) {
                    //         // output data of each row
                    //         while($row = $result->fetch_assoc()) {
                    //             $offer_id=$row["offer_id"];
                    //             $title=$row["title"];
                    //             $f_username=$row["f_username"];
                    //             $timestamp=$row["timestamp"];

                    //             echo '
                    //             <form action="clientProfile.php" method="post">
                    //             <input type="hidden" name="jid" value="'.$offer_id.'">
                    //                 <tr>
                    //                 <td>'.$offer_id.'</td>
                    //                 <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                    //                 </form>
                    //                 <form action="clientProfile.php" method="post">
                    //                 <input type="hidden" name="f_user" value="'.$f_username.'">
                    //                 <td>'.$f_username.'</td>
                    //                 <td>'.$timestamp.'</td>
                    //                 </tr>
                    //             </form>
                    //             ';

                    //             }
                    //     } else {
                    //         echo "<tr><td>N/A</td></tr>";
                    //     }

                       ?>
                  </table>
              </h4></div>
			</div> -->


			

	</div>
<!--End Column 2-->

<!--Column 3-->

<!--End Social Network Profiles-->

	</div>
<!--End Column 3-->

</div>
</div>
<!--End main body-->


<?php include('includes/footer.php') ?>

