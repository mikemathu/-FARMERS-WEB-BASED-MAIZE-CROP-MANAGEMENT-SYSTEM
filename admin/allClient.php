<?php include('server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		// $linkPro="farmerProfile.php";
		$linkPro="clientProfile.php";
		// $linkEditPro="editArtisan.php";
		$linkEditPro="editClient.php";
		$linkBtn="bidOffer.php";
		$textBtn="Bid this Offer";
	}
	else{
		// $linkPro="farmerProfile.php";
		$linkPro="clientProfile.php";
		$linkEditPro="editclient.php";
		$linkBtn="editFarmOutputOffer.php";
		$textBtn="Edit the Offer";
	}
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewClient.php");
}

// $sql = "SELECT * FROM client";
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if(isset($_POST["s_username"])){
	$t=$_POST["s_username"];
	// $sql = "SELECT * FROM client WHERE username='$t'";
	$sql = "SELECT * FROM clients WHERE username='$t'";
	$result = $conn->query($sql);
}

if(isset($_POST["s_name"])){
	$t=$_POST["s_name"];
	// $sql = "SELECT * FROM client WHERE Name='$t'";
	$sql = "SELECT * FROM clients WHERE Name='$t'";
	$result = $conn->query($sql);
}

if(isset($_POST["s_email"])){
	$t=$_POST["s_email"];
	// $sql = "SELECT * FROM client WHERE email='$t'";
	$sql = "SELECT * FROM clients WHERE email='$t'";
	$result = $conn->query($sql);
}

// Delete client
if(isset($_POST["deleteClient"])){
	// $sql = "SELECT * FROM client WHERE email='$t'";
	$sql = "SELECT * FROM clients WHERE email='$t'";


	// $sql = "DELETE FROM apply WHERE offer_id='$offer_id'";
	// $result = $conn->query($sql);
	// if($result==true){
	// 	$sql = "UPDATE farm_output SET valid=0 WHERE offer_id='$offer_id'";
	// 	$result = $conn->query($sql);
	// 	if($result==true){
	// 		header("location: offerDetails.php");
	// 	}
	// }

}

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>All Artisan</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../awesome/css/fontawesome-all.min.css">

<style>
	body{padding-top: 3%;margin: 0;}
	.card{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background:#fff}
</style>

</head>
<body>

<!--Navbar menu-->
<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
	<div class="container">
		<div class="navber-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">Freelance Marketplace</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="farmOutput.php">Browse all Crop Offers</a></li>
				<li><a href="allClients.php">Browse Clients</a></li>
				<li><a href="allclients.php">Browse clients</a></li>
				<li class="dropdown" style="background:#000;padding:0 20px 0 20px;">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?>
			        </a>
			        <ul class="dropdown-menu list-group list-group-item-info">
			        	<a href="<?php echo $linkPro; ?>" class="list-group-item"><span class="glyphicon glyphicon-home"></span>  View profile</a>
			          	<a href="<?php echo $linkEditPro; ?>" class="list-group-item"><span class="glyphicon glyphicon-inbox"></span>  Edit Profile</a>
					  	<a href="message.php" class="list-group-item"><span class="glyphicon glyphicon-envelope"></span>  Messages</a> 
					  	<a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-ok"></span>  Logout</a>
			        </ul>
			    </li>
			</ul>
		</div>		
	</div>	
</nav>
<!--End Navbar menu-->


<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--Client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>All Clients</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                      <td style="font-weight:bold; padding-bottom:10px;">Photo</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Username</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Name</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Email</td>
                      </tr>
                      <?php 
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $f_username=$row["username"];
								$Name=$row["Name"];
								// $id=$row["id"];
                                $photo = (!empty($row['photo'])) ? 'image/'.$row['photo'] : 'image/profile.jpg';
                                $email=$row["email"];

                                echo '
                                <form action="allClients.php" method="post">
                                <input type="hidden" name="f_user" value="'.$f_username.'">
                                    <tr>
                                    <td> <img src="".$photo."" height="30px" width="30px"></td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
                                    <td>'.$Name.'</td>
                                    
									<td>'.$email.'</td>
									
									<td>
									<form id="registrationForm" method="post">
								
									<button type="submit" name="deleteClient" class="btn btn-danger btn-lg">Delete</button>
									
									</form>
								  
								  </td>
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
<!--End Artusan Profile Details-->

	</div>
<!--End Column 1-->


<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<form action="allClients.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_username">
				  <center><button type="submit" class="btn btn-info">Search by username</button></center>
				</div>
	        </form>

	        <form action="allClients.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_name">
				  <center><button type="submit" class="btn btn-info">Search by Name</button></center>
				</div>
	        </form>

	        <form action="allClients.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_email">
				  <center><button type="submit" class="btn btn-info">Search by Email</button></center>
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


<!--Footer-->
<div class="text-center" style="padding:4%;background:#222;color:#fff;margin-top:20px;">
	<div class="row">
			<div class="col-lg-3">
			<h3>Quick Links</h3>
			<p><a href="index.php">Home</a></p>
			<p><a href="farmOutput.php">Browse all Crop Offers</a></p>
			<p><a href="allClients.php">Browse Clientss</a></p>
			<p><a href="allclients.php">Browse clients</a></p>
		</div>
		<div class="col-lg-3">
			<h3>About Us</h3>
			<p>Rahamat-E-Elahi, CUET ID-1304054</p>
			<p>Shovagata Sarker Borno, CUET ID-1304041</p>
			<p>Md. Sharifullah, CUET ID-1304049</p>
			<p>&copy 2018</p>
		</div>
		<div class="col-lg-3">
			<h3>Contact Us</h3>
			<p>Chittagong University of Engineering and Technology</p>
			<p>Chittagong, Bangladesh</p>
			<p>&copy CUET 2018</p>
		</div>
		<div class="col-lg-3">
			<h3>Social Contact</h3>
			<p style="font-size:20px;color:#3B579D;"><i class="fab fa-facebook-square"> Facebook</i></p>
			<p style="font-size:20px;color:#D34438;"><i class="fab fa-google-plus-square"> Google</i></p>
			<p style="font-size:20px;color:#2CAAE1;"><i class="fab fa-twitter-square"> Twitter</i></p>
			<p style="font-size:20px;color:#0274B3;"><i class="fab fa-linkedin"> Linkedin</i></p>
		</div>
	</div>
</div>
<!--End Footer-->


<script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>