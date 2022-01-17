<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		$linkPro="clientProfile.php";
		$linkEditPro="editClient.php";
		$linkBtn="bidOffer.php";
		$textBtn="Bid this Offer";
	}
	else{
		$linkPro="clientProfile.php";
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
	// header("location: sendMessage.php");
	header("location: messageToAdmins.php");

	if(isset($_SESSION["f_user"])){
		$f_user=$_SESSION["f_user"];
		$_SESSION["msgRcv"]=$f_user;
	}
}



$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

if(isset($_POST["s_username"])){
	$t=$_POST["s_username"];
	$sql = "SELECT * FROM admin WHERE username='$t'";
	$result = $conn->query($sql);
}

if(isset($_POST["s_name"])){
	$t=$_POST["s_name"];
	$sql = "SELECT * FROM admin WHERE Name='$t'";
	$result = $conn->query($sql);
}


include('includes/header.php');

include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--Client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>All Admins</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;"></td>
                          <td style="font-weight:bold; padding-bottom:10px;">Contact</td>
                      </tr>
                      <?php 
					  
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
								$f_username=$row["username"];
                                $contact=$row["contact"];

                                echo "
                                <form action='contactAdmin.php' method='post'>
									<tr>
										<input type='hidden' name='f_user' value='".$f_username."'>
										<td><input type='submit' class='btn btn-link btn-lg' value='".$f_username."'>
										</td>				
										<td>".$contact." </td>									
									</tr>
                                </form>
                                ";
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

	</div>
<!--End Column 2-->

</div>
</div>
<!--End main body-->


<?php include('includes/footer.php');?>