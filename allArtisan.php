<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		$linkPro="artisanProfile.php";
		$linkEditPro="editArtisan.php";
		$linkBtn="applyJob.php";
		$textBtn="Apply for this job";
	}
	else{
		$linkPro="employerProfile.php";
		$linkEditPro="editEmployer.php";
		$linkBtn="editJob.php";
		$textBtn="Edit the job offer";
	}
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewArtisan.php");
}

$sql = "SELECT * FROM freelancer";
$result = $conn->query($sql);

if(isset($_POST["s_username"])){
	$t=$_POST["s_username"];
	$sql = "SELECT * FROM freelancer WHERE username='$t'";
	$result = $conn->query($sql);
}

if(isset($_POST["s_name"])){
	$t=$_POST["s_name"];
	$sql = "SELECT * FROM freelancer WHERE Name='$t'";
	$result = $conn->query($sql);
}

if(isset($_POST["s_email"])){
	$t=$_POST["s_email"];
	$sql = "SELECT * FROM freelancer WHERE email='$t'";
	$result = $conn->query($sql);
}

include('includes/header.php');

include('includes/dashboard-navbar.php');

 ?>






<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--Artisan Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>All Artisans</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
					 	 <td style="font-weight:bold; padding-bottom:10px;">photo</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Username</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Professional Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Email</td>
                      </tr>
                      <?php 
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
								$photo=(!empty($row['photo'])) ? 'image/'.$row['photo'] : 'image/profile.jpg';
                                $f_username=$row["username"];
                                $prof_title=$row["prof_title"];
                                $email=$row["email"];

                                echo "
                                <form action='allArtisan.php' method='post'>
                                <input type='hidden' name='f_user' value='".$f_username."'>
									<tr>
									<td>
                                    <img src='".$photo."' height='30px' width='30px'>                     
                                  </td>
									<td><input type='submit' class='btn btn-link btn-lg' value='".$f_username."'></td>									
                                    <td>".$prof_title."</td>
                                    <td>".$email."</td>
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

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<form action="allArtisan.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_username">
				  <center><button type="submit" class="btn btn-info">Search by username</button></center>
				</div>
	        </form>

	        <form action="allArtisan.php" method="post">
				<div class="form-group">
				  <input type="text" class="form-control" name="s_name">
				  <center><button type="submit" class="btn btn-info">Search by Name</button></center>
				</div>
	        </form>

	        <form action="allArtisan.php" method="post">
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


<?php include('includes/footer.php');?>