<?php
 include('../includes/server.php');

if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==2) {
		$linkPro="farmerProfile.php";
		$linkEditPro="editartisan.php";
		$linkBtn="bidOffer.php";
	}
	else{
		$linkPro="farmerProfile.php";
		$linkEditPro="editclient.php";
		$linkBtn="editFarmOutputOffer.php";
	}
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

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewclient.php");
}

if(isset($_POST["c_letter"])){
	$_SESSION["c_letter"]=$_POST["c_letter"];
	header("location: coverLetter.php");
}

	// Get ArtisanID
	$artisanName = $_SESSION["Username"];
	
	$checkArtisanID = mysqli_query
	($conn, "SELECT * FROM admin WHERE username= '$artisanName' ");
	
	if(mysqli_num_rows($checkArtisanID) > 0){
		$row   = mysqli_fetch_row($checkArtisanID);
	
		 $artisanId = $row[0];
	   }

if(isset($_POST["f_done"])){
	$f_done=$_POST["f_done"];
	$sql = "UPDATE selected_farminput SET valid=0 WHERE job_id='$job_id'";
	$result = $conn->query($sql);
    if($result==true){
    	header("location: offerDetails.php");
    }
}

$sql = "SELECT * FROM postcontent WHERE id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $timestamp=$row["timestamp"];
		$title=$row["title"];
		$body=$row["body"];
		$category=$row["category"];
		$posted_by=$row["posted_by"];
        }
} else {
    echo "0 results";
}

$_SESSION["msgRcv"]=$posted_by;

include('includes/header.php');
	
include('includes/admin-navbar.php');
 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
              <div class="panel-heading"><h4><?php echo $title; ?></h4></div>
			</div>
			<div class="panel">
			</div>
			<div class="panel panel-success">
			  <div class="panel-body"><h4><?php echo $body; ?></h4></div>
			</div>		
		</div>
<!--End client Profile Details-->
  
<!--client Profile Details-->	
		<div id="applicant" class="card" >
			<div class="panel">
			  <div class="panel-heading"></div>
			  <div class="panel-body"></div>
			</div>
			<p></p>
		</div>
<!--End client Profile Details-->
	</div>
<!--End Column 1-->

<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->

<!--Contact Information-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h4>Blog Details</h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Posted By</div>
			  <div class="panel-body"><?php echo $posted_by; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Category</div>
			  <div class="panel-body"><?php echo $category; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Posted On</div>
			  <div class="panel-body"><?php echo $timestamp; ?></div>
			</div>
		</div>
<!--End Contact Information-->
	</div>
<!--End Column 2-->
</div>
</div>
<!--End main body-->


<?php
 include('includes/footer.php');
?>

<script>

$(function(){

$(document).on('click', '.edit', function(e){
  e.preventDefault();
  $('#edit').modal('show');
  var id = $(this).data('id');
  getRow(id);
});

$(document).on('click', '.delete', function(e){
  e.preventDefault();
  $('#delete').modal('show');
  var id = $(this).data('id');
  getRow(id);
});

$(document).on('click', '.photo', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  getRow(id);
});

$(document).on('click', '.status', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  getRow(id);
});

});

</script>