<?php
 include('includes/server.php');

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
	//header("location: index.php");
}

if(isset($_SESSION["offer_id"])){
    $offer_id=$_SESSION["offer_id"];
}
else{
    $offer_id="";
    //header("location: index.php");
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
	// ($conn, "SELECT * FROM artisan WHERE username= '$artisanName' ");
	($conn, "SELECT * FROM clients WHERE username= '$artisanName' ");
	
	if(mysqli_num_rows($checkArtisanID) > 0){
		$row   = mysqli_fetch_row($checkArtisanID);
	
		 $artisanId = $row[0];
	   }


if(isset($_POST["f_hire"])){
	$f_hire=$_POST["f_hire"];
	$f_price=$_POST["f_price"];

	
	// Get ClientID

// $checkClientID = mysqli_query
// ($conn, "SELECT * FROM apply WHERE bid= '$offer_id' ");

// if(mysqli_num_rows($checkClientID) > 0){
//     $row   = mysqli_fetch_row($checkClientID);

//      $clientId = $row[0];
//    }

// 		echo $clientId;


	$sql = "INSERT INTO selected (artisanid,f_username, offer_id, e_username, price, valid) VALUES ('$artisanid','$f_hire', '$offer_id', '$username','$f_price',1)";
    
    $result = $conn->query($sql);
    if($result==true){
    	$sql = "DELETE FROM apply WHERE offer_id='$offer_id'";
		$result = $conn->query($sql);
		if($result==true){
			// $sql = "UPDATE farm_output SET valid=0 WHERE offer_id='$offer_id'";
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
	$sql = "UPDATE selected SET valid=0 WHERE offer_id='$offer_id'";
	$result = $conn->query($sql);
    if($result==true){
    	header("location: offerDetails.php");
    }
}


// $sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$sql = "SELECT * FROM farm_output WHERE offer_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$e_username=$row["e_username"];
        $title=$row["title"];
        $description=$row["description"];
        $budget=$row["budget"];
        // $location=$row["location"];
        $timestamp=$row["timestamp"];
        $jv=$row["valid"];
        // $deadline=$row["deadline"];
        }
} else {
    echo "0 results";
}

$_SESSION["msgRcv"]=$e_username;

include('includes/header.php');

// include('includes/dashboard-navbar.php');

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
			  <div class="panel-heading"><h3>Job Offer Details</h3></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Job Title</div>
			  <div class="panel-body"><h4><?php echo $title; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Job Description</div>
			  <div class="panel-body"><h4><?php echo $description; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Budget</div>
			  <div class="panel-body"><h4><?php echo $budget; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Location</div>
			  <div class="panel-body"><h4><?php //echo $location; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Deadline</div>
			  <div class="panel-body"><h4><?php // echo $deadline; ?></h4></div>
			</div>

			<a href="<?php echo $linkBtn; ?>" id="applybtn" type="button" class="btn btn-warning btn-lg"><?php echo $textBtn; ?></a>
			<p></p>
		</div>
<!--End client Profile Details-->
 

 
 
<!--client Profile Details-->	
		<div id="applicant" class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Bid this Offer</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                  <tr>
                      <td>Bidder's username</td>
                      <td>Bid</td>
                  </tr>
					<?php 
					
// 					$query=mysqli_query($conn, "select * from `artisan` left join `selected` on selected.f_username=artisan.username") or die(mysqli_error());


// while($row=mysqli_fetch_array($query)){
// $artisanid = $row['artisanid'];
// $artisanemail = $row['email'];
// }
// echo $artisanemail;
// echo $artisanid;

 $sql = "SELECT * FROM apply WHERE offer_id='$offer_id' ORDER BY bid";
					$result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
						$artisanid=$row["artisanid"];

$query=mysqli_query($conn, "select * from `apply` left join `artisan` on artisan.artisanid=apply.artisanid where offer_id='$offer_id' ORDER BY bid") or die(mysqli_error());
						}
					}
				
if ($result->num_rows > 0) {
	// if ($result->num_rows > 0 && $_SESSION["Usertype"] == 2 ) {
	
						 while($row=mysqli_fetch_array($query)){
							$artisanid=$row["artisanid"];
						
                        $f_username=$row["username"];
                        $bid=$row["bid"];
                        $cover_letter=$row["cover_letter"];
						 


                  
					
						echo '
                        <form action="offerDetails.php" method="post">
                        <input type="hidden" name="f_user" value="'.$f_username.'">
                            <tr>
                            <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
							<td>'.$bid.'</td>
                            </form>
                            <form action="offerDetails.php" method="post">
                            <input type="hidden" name="c_letter" value="'.$cover_letter.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="cover letter"></td>
                            </form>
                            <form action="offerDetails.php" method="post">
                            <input type="hidden" name="f_hire" value="'.$f_username.'">
                            <input type="hidden" name="f_price" value="'.$bid.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="Hire"></td>
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
									$tc="Job ended";
									$tv="";
                                }else{					
									 
									 $tc="End Job";
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
// ($conn, "SELECT * FROM client WHERE username= '$username' ");
($conn, "SELECT * FROM clients WHERE username= '$username' ");

if(mysqli_num_rows($checkartisanName) > 0){
    $row   = mysqli_fetch_row($checkartisanName);

     $username= $row[3];
   }


// $query=mysqli_query($conn, "select * from `artisan` left join `selected` on selected.f_username=artisan.username") or die(mysqli_error());
$query=mysqli_query($conn, "select * from `freelancer` left join `selected` on selected.f_username=freelancer.username") or die(mysqli_error());


						 while($row=mysqli_fetch_array($query)){
						//  $artisanid = $row['artisanid'];
						 $artisanemail = $row['email'];
						 }
?>
<?php
									 


									 














                                	
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
$sql = "SELECT * FROM clients WHERE username='$e_username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	// $e_Name=$row["Name"];
        $email=$row["email"];
        $contact_no=$row["contact_no"];
		$address=$row["address"];
		// $photo=$row["photo"];
        }
} else {
    // echo "0 results";
}

?>

<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>

			<!-- <img src="image/img04.jpg"> -->
			<img src="<?php echo (!empty($photo)) ? 'image/'.$photo : 'image/profile.jpg'; ?>" width="100%">
			<h2><?php //echo $e_Name; ?></h2>
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
			  <div class="panel-heading"><h4>Contact Information</h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Email</div>
			  <div class="panel-body"><?php echo $email; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Mobile</div>
			  <div class="panel-body"><?php echo $contact_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Address</div>
			  <div class="panel-body"><?php echo $address; ?></div>
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

 include('includes/review_modal.php');


include('includes/job_modal.php'); 
?>


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




