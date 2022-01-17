<?php
 include('includes/server.php');

//  Add to cart
if (isset($_POST["add_to_cart"])) 
{
  $av = $_POST['av'];
$qq = $_POST["quant"];
if ($av > 0) {

  if ($av > $qq || $av == $qq)  {

  if (isset($_SESSION["cart"])) 
{
  $itemarrayid = array_column($_SESSION["cart"], "ids");
  if (!in_array($_GET["id"], $itemarrayid)) {
   
    $count=count($_SESSION["cart"]);
    $itemarray = array(
     'ids' => $_GET["id"],
     'name' => $_POST["hiddenname"],
     'price' => $_POST["hiddenprice"],
     'quantity' => $_POST["quant"]);
     $_SESSION["cart"][$count] = $itemarray;
    echo "<script>alert('Product is added to your cart!')</script>";
    echo "<script>window.location = 'cart.php'</script>";
  }else{
    echo "<script>alert('Item Already Added')</script>";
    echo "<script>window.location = 'cart.php'</script>";
  }
}
else
{
  $itemarray = array(
  'ids' => $_GET["id"], 
  'name' => $_POST["hiddenname"],
  'price' => $_POST["hiddenprice"],
  'quantity' => $_POST["quant"]);
  $_SESSION['cart'][0] = $itemarray;
}
}else{
        echo '<script>alert("Invalid Quantity")</script>';
      echo '<script>window.location="index.php"</script>';

}
}else{
  echo '<script>alert("Out of Stocks")</script>';
      echo '<script>window.location="index.php"</script>';
}
}

if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	// if ($_SESSION["Usertype"]==1) {
		$linkPro="farmerProfile.php";
		$linkEditPro="editartisan.php";
		$linkBtn="bidRequest.php";
		$textBtn="Buy";
	// }
	// else{
		// $linkPro="farmerProfile.php";
		// $linkEditPro="editclient.php";
		// $linkBtn="editFarmOutputOffer.php";
		// $textBtn="Edit the Offer";
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
	($conn, "SELECT * FROM admin WHERE username= '$artisanName' ");
	
	if(mysqli_num_rows($checkArtisanID) > 0){
		$row   = mysqli_fetch_row($checkArtisanID);
	
		 $artisanId = $row[0];
	   }


if(isset($_POST["f_hire"])){
	$f_hire=$_POST["f_hire"];
	$f_price=$_POST["f_price"];

	$sql = "INSERT INTO selected (f_username, offer_id, e_username, price, valid) VALUES ('$f_hire', '$offer_id', '$username','$f_price',1)";
    
    $result = $conn->query($sql);
    if($result==true){
    	$sql = "DELETE FROM apply WHERE offer_id='$offer_id'";
		$result = $conn->query($sql);
		if($result==true){
			$sql = "UPDATE farm_input SET valid=0 WHERE id='$offer_id'";
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

$sql = "SELECT * FROM farm_input WHERE item_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$e_username=$row["e_username"];
        $timestamp=$row["timestamp"];
        $jv=$row["valid"];

		$title=$row["title"];
		$item_type=$row["item_type"];
		$description=$row["description"];
		$quantity=$row["quantity"];
		$selling_price=$row["selling_price"];
        }
} else {
    echo "0 results";
}

$_SESSION["msgRcv"]=$e_username;

include('includes/header.php');
	
include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-7">

<!--client Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Farm Input</h3></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Title</div>
			  <div class="panel-body"><h4><?php echo $title; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Item Type</div>
			  <div class="panel-body"><h4><?php echo $item_type; ?></h4></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Description</div>
			  <div class="panel-body"><h4><?php echo $description; ?></h4></div>
			</div>
			<!-- <div class="panel panel-success">
			  <div class="panel-heading">Quantity</div>
			  <div class="panel-body"><h4><?php //echo 'Available Quantity:'. $quantity; ?></h4></div>
			  <input class="form-control" type="number" min="0" placeholder="Choose your Quantity" name="quant" value="1">
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Price</div>
			  <div class="panel-body"><h4><?php //echo $selling_price; ?></h4></div>
			</div> -->

			<a href="<?php echo $linkBtn; ?>" id="applybtn" type="button" class="btn btn-warning btn-lg"><?php //echo $textBtn; ?></a>


			<a href="<?php echo $linkBtn; ?>" id="applybtn" type="button" class="btn btn-warning btn-lg"><?php echo $textBtn; ?></a>

			


			<?php

			
function generate_bill(){
	$con=mysqli_connect("localhost","root","","fmarket");
	$pid = $_SESSION['offer_id'];
	$offer_id=$_GET["offer_id"];

	$output='';
	// $query=mysqli_query($con,"select * from `farm_output` left join `selected` on selected.offer_id=farm_output.offer_id where farm_output.offer_id='$offer_id'  ");
	$query=mysqli_query($con,"select * from `farm_input` left join `selected_farminput` on selected_farminput.offer_id=farm_input.item_id where farm_input.item_id='$offer_id'  ");
	// $query=mysqli_query($con,"select * from `farm_input` left join `selected_farminput` on selected_farminput.offer_id=farm_input.id where farm_input.id='$offer_id'  ");


	while($row = mysqli_fetch_array($query)){
	  $output .= '
	  <label> <b>Offer Title:</b> </label>'.$row["title"].'<br/><br/>
	  <label> <b>Item type:</b> </label>'.$row["item_type"].'<br/><br/>
	  <label> <b>Quantity:</b> </label>'.$row["quantity"].'<br/><br/>
	  <label> <b>Price Per Item:</b> Ksh.</label>'.$row["price"].'<br/><br/>
	  <label> <b>Farmer Name:</b> </label>'.$row["f_username"].'<br/><br/>
	  
	  ';
  
	}
	
	return $output;
  }

  
  
  if(isset($_GET["generate_bill"])){
	require_once("TCPDF/tcpdf.php");
	$obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
	$obj_pdf -> SetCreator(PDF_CREATOR);
	$obj_pdf -> SetTitle("MCMS Receipt");
	$obj_pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
	$obj_pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
	$obj_pdf -> SetFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
	$obj_pdf -> SetDefaultMonospacedFont('helvetica');
	$obj_pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf -> SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
	$obj_pdf -> SetPrintHeader(false);
	$obj_pdf -> SetPrintFooter(false);
	$obj_pdf -> SetAutoPageBreak(TRUE, 10);
	$obj_pdf -> SetFont('helvetica','',12);
	$obj_pdf -> AddPage();
  
	$content = '';
  
	$content .= '
		<br/>
		<h2 align ="center"> Maize Crop Management  System</h2></br>
		<h3 align ="center"> Receipt</h3>
		
  
	';
   
	$content .= generate_bill();
	$obj_pdf -> writeHTML($content);
	ob_end_clean();
	$obj_pdf -> Output("receipt.pdf",'I');
  
  }






?>


<div id="applicant" class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Buyers</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                  <tr>
                      <td>Farmer's username</td>
                      <td>Price</td>
                  </tr>
					<?php 

 $sql = "SELECT * FROM apply WHERE offer_id='$offer_id' ORDER BY bid";
					$result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {

$query=mysqli_query($conn, "select * from `apply` left join `farmer` on farmer.username=apply.f_username where offer_id='$offer_id' ORDER BY bid");
						}
					}
				
if ($result->num_rows > 0) {	
						 while($row=mysqli_fetch_array($query)){
						
                        $f_username=$row["username"];
                        $bid=$row["bid"];
                        $cover_letter=$row["cover_letter"];
					
						echo '
                        <form action="farmInputDetails.php" method="post">
                        <input type="hidden" name="f_user" value="'.$f_username.'">
                            <tr>
                            <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
							<td>'.$bid.'</td>
                            </form>
                            <form action="farmInputDetails.php" method="post">
                            <input type="hidden" name="c_letter" value="'.$cover_letter.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="Message"></td>
                            </form>
                            <form action="farmInputDetails.php" method="post">
                            <input type="hidden" name="f_hire" value="'.$f_username.'">
                            <input type="hidden" name="f_price" value="'.$bid.'">
                            <td><input type="submit" class="btn btn-link btn-lg" value="Sell"></td>
                            </tr>
						</form>';					
						
					                     

                        }
                    } else {
                    //   $sql = "SELECT * FROM selected WHERE job_id='$job_id'";
                      $sql = "SELECT * FROM selected_farminput WHERE offer_id='$offer_id'";
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
									<td>'.$tc.'</td>

									</form>		
				<form method="get">
				<input type="hidden" name="offer_id" value="'.$offer_id.'">
				<td><input type = "submit" onclick="alert("Bill Paid Successfully");" name ="generate_bill" class = "btn btn-success" value="Print Receipt"/>	</td>			
			
				</form>
								
                                    </tr>
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

$query=mysqli_query($conn, "select * from `farmer` left join `selected_farminput` on selected_farminput.f_username=farmer.username");


						 while($row=mysqli_fetch_array($query)){
						 }
?>
                     </table>
              </h4></div>
			</div>
			<p></p>
		</div>


		<div id="applicant" class="card" >
			<div class="panel panel-success">
			  <div class="panel-body">
                
					<?php 
					
 $sql = "SELECT * FROM apply WHERE offer_id='$offer_id' ORDER BY bid";
					$result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {

				$query=mysqli_query($conn, "select * from `apply` left join `farmer` on farmer.username=apply.f_username where offer_id='$offer_id' ORDER BY bid");
						}
					}
				
					if ($result->num_rows > 0) {
	
						 while($row=mysqli_fetch_array($query)){
						
                        $f_username=$row["username"];
                        $bid=$row["bid"];
                        $cover_letter=$row["cover_letter"];
					
						// echo '
                        // <form action="offerDetails.php" method="post">
                        // <input type="hidden" name="f_user" value="'.$f_username.'">
                        //     <tr>
                        //     <td><input type="submit" class="btn btn-link btn-lg" value="'.$f_username.'"></td>
						// 	<td>'.$bid.'</td>
                        //     </form>
                        //     <form action="offerDetails.php" method="post">
                        //     <input type="hidden" name="c_letter" value="'.$cover_letter.'">
                        //     <td><input type="submit" class="btn btn-link btn-lg" value="cover letter"></td>
                        //     </form>
                        //     <form action="offerDetails.php" method="post">
                        //     <input type="hidden" name="f_hire" value="'.$f_username.'">
                        //     <input type="hidden" name="f_price" value="'.$bid.'">
                        //     <td><input type="submit" class="btn btn-link btn-lg" value="Sell"></td>
                        //     </tr>
						// </form>';					

                        }
                    } else {
                      $sql = "SELECT * FROM selected_farminput WHERE offer_id='$offer_id'";
					  $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $f_username=$row["f_username"];
                                $bid=$row["price"];
                                $v=$row["valid"];

                                if ($v==0) {
									$tc="sold";
									$tv="";
                                }else{					
									 
									 $tc="End Job";
									$tv="f_done";
								
                                }
								echo '
							

								<form method="get">
				<input type="hidden" name="offer_id" value="'.$offer_id.'">
				<td><input type = "submit" onclick="alert("Bill Paid Successfully");" name ="generate_bill" class = "btn btn-success" value="Print Receipt"/>	</td>			
			
				</form>

				</tr>


                                                             
                                ';

                                }
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
						 }
?>

                     <!-- </table> -->
              </h4></div>
			</div>
			<p></p>
		</div>


		</div>
<!--End client Profile Details-->

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
        $username=$row["username"];
        $contactNo=$row["contact_no"];
        $id_card_no=$row["id_card_no"];
        $location=$row["location"];
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
			  <div class="panel-body"><?php //echo $contactNo; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">ID Card No</div>
			  <div class="panel-body"><?php //echo $id_card_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Location</div>
			  <div class="panel-body"><?php //echo $location; ?></div>
			</div>
			<!-- <a href="<?php //echo $linkBtn; ?>" id="applybtn" type="button" class="btn btn-warning btn-lg"><?php //echo $textBtn; ?></a> -->

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




