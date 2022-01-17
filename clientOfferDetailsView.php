<?php
 include('includes/server.php');

if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	// if ($_SESSION["Usertype"]==2) {
		$linkPro="farmerProfile.php";
		$linkEditPro="editartisan.php";
		$linkBtn="clientBidOffer.php";
		// $textBtn="Bid this Offer";
		$textBtn="Buy ";
	// }
	// else{
	// 	$linkPro="farmerProfile.php";
	// 	$linkEditPro="editclient.php";
	// 	$linkBtn="editFarmOutputOffer.php";
	// 	$textBtn="Edit the Offer";
	// }
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
	($conn, "SELECT * FROM clients WHERE username= '$artisanName' ");
	
	if(mysqli_num_rows($checkArtisanID) > 0){
		$row   = mysqli_fetch_row($checkArtisanID);
	
		 $artisanId = $row[0];
	   }


if(isset($_POST["f_hire"])){
	$f_hire=$_POST["f_hire"];
	$f_price=$_POST["f_price"];

	$sql = "INSERT INTO selected (f_username, offer_id, e_username, price, valid) VALUES ( '$username','$offer_id', '$f_hire','$f_price',1)";
    
    $result = $conn->query($sql);
    if($result==true){
    	$sql = "DELETE FROM apply WHERE offer_id='$offer_id'";
		$result = $conn->query($sql);
		if($result==true){
			$sql = "UPDATE farm_output SET valid=0 WHERE offer_id='$offer_id'";
			$result = $conn->query($sql);
			if($result==true){
				header("location: offerDetails.php");
			}
		}
    }
}


if(isset($_POST["f_done"])){
	$f_done=$_POST["f_done"];
	$sql = "UPDATE selected SET valid=0 WHERE job_id='$job_id'";
	$result = $conn->query($sql);
    if($result==true){
    	header("location: offerDetails.php");
    }
}

$sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$e_username=$row["e_username"];
        $timestamp=$row["timestamp"];
        $jv=$row["valid"];

		$title=$row["title"];
		$maize_type=$row["maize_type"];
		$description=$row["description"];
		$number_of_bags=$row["number_of_bags"];
		$selling_price=$row["selling_price"];
		$location=$row["location"];
        }
} else {
    echo "0 results";
}

$_SESSION["msgRcv"]=$e_username;

include('includes/header.php');

include('includes/client-navbar.php');
 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Offer Details</h3></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Title</div>
			  <div class="panel-body"><h4><?php echo $title; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Type</div>
			  <div class="panel-body"><h4><?php echo $maize_type; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Description</div>
			  <div class="panel-body"><h4><?php echo $description; ?></h4></div>
			</div>
			<!-- <div class="panel panel-success">
			  <div class="panel-heading">Number of Bags</div>
			  <div class="panel-body"><h4><?php //echo $number_of_bags; ?></h4></div>
			</div> -->
			<!-- <div class="panel panel-success">
			  <div class="panel-heading">Price per Bag</div>
			  <div class="panel-body"><h4><?php //echo $selling_price; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Location</div>
			  <div class="panel-body"><h4><?php //echo $location; ?></h4></div>
			</div> -->

			<a href="<?php echo $linkBtn; ?>" id="applybtn" type="button" class="btn btn-warning btn-lg"><?php echo $textBtn; ?></a>
			<p></p>
		</div>
<!--End client Profile Details-->
 
<!--client Profile Details-->	
		<div id="applicant" class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Bidders</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                  <tr>
                      <td style="font-weight: bold; font-style:italic;">Bidder's username</td>
                      <td style="font-weight: bold; font-style:italic;">Bid</td>
                  </tr>
					<?php 

				 $sql = "SELECT * FROM apply WHERE offer_id='$offer_id' ORDER BY bid";
					$result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {

$query=mysqli_query($conn, "select * from `apply` left join `farmer` on farmer.username=apply.f_username where offer_id='$offer_id' ORDER BY bid");
						}
					}
				
if ($result->num_rows > 0) {	
						 while($row=mysqli_fetch_array($query)){
                        $f_username=$row["f_username"];
                        $bid=$row["bid"];
                        $cover_letter=$row["cover_letter"];
				
						echo '
                        <form action="offerDetails.php" method="post">
                        <input type="hidden" name="f_user" value="'.$f_username.'">
                            <tr>
							<td>'.$f_username.'</td>
							<td>'.$bid.'</td>
                            </form>
                        <form action="offerDetails.php" method="post">
                            <input type="hidden" name="c_letter" value="'.$cover_letter.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="Message"></td>
                        </form>
                        <form action="offerDetails.php" method="post">
                            <input type="hidden" name="f_hire" value="'.$f_username.'">
                            <input type="hidden" name="f_price" value="'.$bid.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="Accept Bid"></td>
                            </tr>
						</form>';					

                        }
                    } else {
                      $sql = "SELECT * FROM selected WHERE offer_id='$offer_id'";
					  $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $f_username=$row["f_username"];
                                $bid=$row["price"];
                                $v=$row["valid"];

                                if ($v==0) {
									$tc="Sold";
									$tv="";
                                }else{					
									 
									 $tc="Confirm Sale";
									$tv="f_done";
								
                                }
								echo '
								
								<form action="offerDetails.php?id=<?php echo $id; ?>" method="post">
                                <input type="hidden" name="f_user" value="'.$f_username.'">
                                    <tr>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
                                    <td>'.$bid.'</td>
                                    </form>
                                    <form action="offerDetails.php" method="post">
                                    <input type="hidden" name="'.$tv.'" value="'.$f_username.'">
									<td><input type="submit" class="btn btn-link btn-lg" value="'.$tc.'"></td>
								
                                    </tr>
								</form>
								
								<form action="artisanreview.php?id=<?php echo $id; ?>" method="post">
								<input type="submit" class="btn btn-link btn-lg" value="Review this artisan">							
								</form>
                                ';

                                }
                        } else {
                            echo "<tr></tr><tr><td></td><td>Nothing to show</td></tr>";
                        }
						}		  

						 $checkartisanName = mysqli_query
($conn, "SELECT * FROM clients WHERE username= '$username' ");

if(mysqli_num_rows($checkartisanName) > 0){
    $row   = mysqli_fetch_row($checkartisanName);

     $username= $row[3];
   }

$query=mysqli_query($conn, "select * from `farmer` left join `selected` on selected.f_username=farmer.username");
						 while($row=mysqli_fetch_array($query)){
						 $artisanemail = $row['email'];
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

<?php 
// $sql = "SELECT * FROM client WHERE username='$e_username'";
$sql = "SELECT * FROM farmer WHERE username='$e_username'";
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
}

?>

<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<img src="<?php echo (!empty($photo)) ? 'image/'.$photo : 'image/profile.jpg'; ?>" width="100%">
			<p><span class="glyphicon glyphicon-user"></span> <?php echo $e_username; ?></p>

			<?php

if ($_SESSION["Usertype"] == 1) {
	echo '
	<center><a href="sendMessage.php" class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span>  Send Message</a></center> ';
}

?>
	      
	        <p></p>
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
			  <div class="panel-heading">ID Card N0</div>
			  <div class="panel-body"><?php echo $id_card_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Location</div>
			  <div class="panel-body"><?php echo $farm_location; ?></div>
			</div>
		
		</div>
<!--End Contact Information-->

	</div>
<!--End Column 2-->

<!--Column 3-->

</div>
</div>
<!--End main body-->


<?php
 include('includes/footer.php');

if($e_username!=$username && $_SESSION["Usertype"]!=1){
	echo "<script>
		        $('#applybtn').hide();
		</script>";
} 

if($_SESSION["Usertype"]==1 && $jv==0){
	echo "<script>
		        $('#applybtn').hide();
		</script>";
} 

if($e_username!=$username){
	echo "<script>
		        $('#applicant').hide();
		</script>";
}

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
