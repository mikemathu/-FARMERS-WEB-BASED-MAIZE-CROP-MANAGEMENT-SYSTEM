<?php include('includes/server.php');
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
		$textBtn="Edit the Crop Offer";
	}
}
else{
    $username="";
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: postDetails.php");
}

include('includes/header.php');

$userName =  $_SESSION['Username'];

include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Blogs</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td style="font-weight:bold; padding-bottom:10px;">Id</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Title</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Category</td>
                          <td style="font-weight:bold; padding-bottom:10px;">Posted By</td>
                      </tr>
                      <?php 
                      
$sql = "SELECT * FROM postcontent order by id desc ";
$result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
								
                                $id=$row["id"];
                                $title=$row["title"];
								$body=$row["body"];
								$category=$row["category"];
								$posted_by=$row["posted_by"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="readPosts.php" method="post">
                                <input type="hidden" name="jid" value="'.$id.'">
                                    <tr>
                                    <td>'.$id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$category.'</td>
                                    <td>'.$timestamp.'</td>
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
<!--End client Profile Details-->
	</div>
<!--End Column 1-->

</div>
</div>
<!--End main body-->

<?php 

include('includes/footer.php'); 
?>


