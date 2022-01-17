<?php include('server.php');
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
		$textBtn="Edit the Offer";
	}
}
else{
    $username="";
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewFarmers.php");
}

$sql = "SELECT * FROM farmer";
$result = $conn->query($sql);

if(isset($_POST["s_username"])){
	$t=$_POST["s_username"];
	$sql = "SELECT * FROM farmer WHERE username='$t'";
	$result = $conn->query($sql);
}
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>MCMS</title>
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
<?php include('includes/admin-navbar.php'); ?>

<!--End Navbar menu-->

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--Client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>All Farmers</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Username</td>
                      
                          <td style="font-weight:bold; padding-bottom:10px;">Contact No</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Id Card No</td>
                      </tr>
                      <?php 
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $f_username=$row["username"];
                                $contactNo=$row["contact_no"];
                                $IdCardNo=$row["id_card_no"];

                                echo '
                                <form action="allFarmers.php" method="post">
                                <input type="hidden" name="f_user" value="'.$f_username.'">
									<tr>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>                                   
                                    <td>'.$contactNo.'</td>
                                    <td>'.$IdCardNo.'</td>
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

<?php

if(isset($_POST['btndelete']))
{
  $username=$_POST['username'];
  $query="delete from farmer where username='$username';";
  $result=mysqli_query($conn,$query);
  if($result)
    {
      echo "<script>alert(' Deleted successfully!');</script>";
  }
  else{
    echo "<script>alert('Unable to delete!');</script>";
  }
}


?>
<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Delete Action</h3></div>
			  <div class="panel-body">
			<form  class="form-horizontal" action="allFarmers.php" method="post">					
				<lable>Username</lable>
				<input class="form-control" style="max-width:300px; margin-bottom:20px;" name="username" placeholder="username" type="text" >
				<input class="btn btn-danger" name="btndelete" value="Delete" type="submit" >
			</form>
					</div>
				</div>
</div>

	</div>
<!--End Column 1-->


<!--Column 2-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<form action="allFarmers.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_username">
				  <center><button type="submit" class="btn btn-info">Search by username</button></center>
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

<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>