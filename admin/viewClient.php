<?php include('../includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		$linkPro="farmerProfile.php";
		$linkEditPro="editartisan.php";
		$linkBtn="bidOffer.php";
		$textBtn="Bid this Offer";
	}
	else{
		$linkPro="farmerProfile.php";
		$linkEditPro="editclient.php";
		$linkBtn="editFarmOutputOffer.php";
		$textBtn="Edit the Offer";
	}
}
else{
    $username="";
}

if(isset($_SESSION["f_user"])){
	$f_user=$_SESSION["f_user"];
	$_SESSION["msgRcv"]=$f_user;
}

$sql = "SELECT * FROM clients WHERE username='$f_user'";
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

include('includes/header.php');

if ($_SESSION["Usertype"]=1) {
	
	include('includes/admin-navbar.php');
}
else if($_SESSION["Usertype"]=2){
	include('includes/farmer-navbar.php');

	}
 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<img src="<?php echo (!empty($photo)) ? 'image/'.$photo : '../image/profile.jpg'; ?>" width="100%">
			<h2><?php echo $name; ?></h2>
			<p><span class="glyphicon glyphicon-user"></span> <?php echo $f_user; ?></p>

			<?php

	echo '
	<center><a href="sendMessage.php" class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span>  Send Message</a></center> ';

?>
	     
	    </div>
<!--End Main profile card-->

	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-7">

<!--client Profile Details-->	
			
<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">

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
<!--End client Profile Details-->

	</div>
<!--End Column 2-->

</div>
</div>
<!--End main body-->


<?php include('includes/footer.php');?>

