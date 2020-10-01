<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
	$username="";
	//header("location: index.php");
}

if(isset($_POST["jid"])){
	$_SESSION["job_id"]=$_POST["jid"];
	header("location: jobDetails.php");
}

if(isset($_POST["e_user"])){
	$_SESSION["e_user"]=$_POST["e_user"];
	header("location: viewclient.php");
}


$sql = "SELECT * FROM artisan WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$name=$row["Name"];
		$email=$row["email"];
		$contactNo=$row["contact_no"];
		$gender=$row["gender"];
		$birthdate=$row["birthdate"];
		$address=$row["address"];
		$prof_title=$row["prof_title"];
		$location=$row["location"];
		$profile_sum=$row["profile_sum"];
		$experience=$row["experience"];
		$photo=$row["photo"];
	    }
} else {
    echo "0 results";
}

include('includes/header.php');

include('includes/artisan-navbar.php');
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
	          	<a href="editArtisan.php" class="list-group-item list-group-item-info">Edit Profile</a>
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
			  <div class="panel-body"><?php echo $email; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Mobile</div>
			  <div class="panel-body"><?php echo $contactNo; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Address</div>
			  <div class="panel-body"><?php echo $address; ?></div>
			</div>
		</div>
<!--End Contact Information-->

<!--Reputation-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-warning">
			  <div class="panel-heading"><h4>Reputation</h4></div>
			</div>
			<div class="panel panel-warning">
			  <div class="panel-heading">Rating</div>
			  <div class="panel-body">
			  <?php
			  include('includes/rating.php');
			  ?>
			  
			  </div>
			</div>
			
		</div>
<!--End Reputation-->

	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-6">

<!--Artisan Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-primary">
			  <div class="panel-heading"><h3>Artisan Profile Details</h3></div>
			</div>

			<?php if(!empty($prof_title)){ ?>
				<div class="panel panel-primary">
				  	<div class="panel-heading">Professional Title</div>
					  <div class="panel-body">	<h4> <?php echo $prof_title; ?> </h4></div>
					   <!-- <div class="panel-body"><h4><?php //echo $profile_sum; ?></h4></div> -->
	           </div>
           <?php }?>

			<?php if(!empty($skills)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Skills</div>
					<h4> <?php echo $skills; ?> </h4>
					<!-- <div class="panel-body"><h4><?php //echo $profile_sum; ?></h4></div> -->
				</div>
			<?php }?>

			<?php	if(!empty($profile_sum)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Profile Summery</div>
					<div class="panel-body"><h4> <?php echo $profile_sum; ?> </h4></div>
					<!-- <div class="panel-body"><h4><?php //echo $profile_sum; ?></h4></div> -->
				</div>
			<?php }?>			

			<?php	if(!empty($education)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Education</div>
					<div class="panel-body"><h4> <?php echo $education; ?> </h4></div>
					<!-- <div class="panel-body"><h4><?php //echo $profile_sum; ?></h4></div> -->
				</div>
			<?php }?>
			
			<?php	if(!empty($experience)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">Experience</div>
					<div class="panel-body"><h4> <?php echo $experience; ?> </h4></div>
					<!-- <div class="panel-body"><h4><?php //echo $profile_sum; ?></h4></div> -->
				</div>
			<?php }?>
		
			<div class="panel panel-primary">
			  <div class="panel-heading">Current jobs</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Job Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">client</td>
                      </tr>
                      <?php 
                      	$sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.f_username='$username' AND selected.valid=1 ORDER BY job_offer.timestamp DESC";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $job_id=$row["job_id"];
                                $title=$row["title"];
                                $e_username=$row["e_username"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="clientProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$job_id.'">
                                    <tr>
                                    <td>'.$job_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    </form>
                                    <form action="clientProfile.php" method="post">
                                    <input type="hidden" name="e_user" value="'.$e_username.'">
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$e_username.'"></td>
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
			  <div class="panel-heading">Previous Works</div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Job Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">client</td>
                      </tr>
                      <?php 
                      	$sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.f_username='$username' AND selected.valid=0 ORDER BY job_offer.timestamp DESC";
						$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $job_id=$row["job_id"];
                                $title=$row["title"];
                                $e_username=$row["e_username"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="artisanProfile.php" method="post">
                                <input type="hidden" name="jid" value="'.$job_id.'">
                                    <tr>
                                    <td>'.$job_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    </form>
                                    <form action="artisanProfile.php" method="post">
                                    <input type="hidden" name="e_user" value="'.$e_username.'">
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$e_username.'"></td>
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

							  
     







			<div>			
			</div>
		</div>
<!--End Artisan Profile Details-->

	</div>
<!--End Column 2-->


<!--Column 3-->
	<div class="col-lg-3">
<!--My Wallet-->
<div style="margin-top:20px">


<div>
<div class="panel panel-default" style="height: 400px;">
    <div style="height:10px;"></div>
    <span style="margin-left:10px;">Welcome to Chatroom</span><br>
    <span style="font-size:10px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to avoid banning of account</i></span>
    <div style="height:10px;"></div>
    <div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">
    <?php
		include('chat.php');
    ?>
    </div>
</div>
<form method="POST" action="">
<div class="input-group">
    <input type="text" class="form-control" placeholder="Type message..." name="chat_msg">
    <span class="input-group-btn">
    <button class="btn btn-success" type="submit" name="send_msg" value="<?php echo $id; ?>">
    <span class="glyphicon glyphicon-comment"></span> Send
    </button>
    </span>
</div>
</form>

</div>

</div>
<!--End My Wallet-->


	</div>
<!--End Column 3-->

</div>
</div>
<!--End main body-->


<?php include('includes/footer.php'); ?>