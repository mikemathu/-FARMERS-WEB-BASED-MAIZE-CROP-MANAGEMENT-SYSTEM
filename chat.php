<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
	$username="";
}

if(isset($_POST["jid"])){
	$_SESSION["offer_id"]=$_POST["jid"];
	header("location: offerDetailsInfo.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewClient.php");
}


$sql = "SELECT * FROM farmer WHERE username='$username'";
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
} else {
    echo "0 results";
}

$sql = "SELECT * FROM farm_output WHERE e_username='$username' and valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);



include('includes/header.php');

include('includes/farmer-navbar.php');

 ?>

<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-3">

<!--Main profile card-->
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<p></p>
			<img src="<?php echo (!empty($photo)) ? 'image/'.$photo : 'image/profile.jpg'; ?>" width="100%">
			
			<h2><?php //echo $name; ?></h2>
			<p><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></p>
			<ul class="list-group">
				<a href="postFarmOutput.php" class="list-group-item list-group-item-info">Sell Your Maize Here</a>
				<a href="chatapp.php" class="list-group-item list-group-item-info">Chat</a>
	          	<a href="editFarmer.php" class="list-group-item list-group-item-info">Edit Profile</a>
			  	<a href="message.php" class="list-group-item list-group-item-info">Messages</a>
			  	<a href="logout.php" class="list-group-item list-group-item-info">Logout</a>
	        </ul>
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
			  <div class="panel-heading">ID Card No</div>
			  <div class="panel-body"><?php echo $id_card_no; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Farm Location</div>
			  <div class="panel-body"><?php echo $farm_location; ?></div>
			</div>
      <div class="panel panel-success">
			  <div class="panel-heading">Farm Size</div>
			  <div class="panel-body"><?php echo $farm_size .' (ha)'; ?></div>
			</div>
			<div class="panel panel-success">
			  <div class="panel-heading">Soil Type</div>
			  <div class="panel-body"><?php echo $soil_type; ?></div>
			</div>
		
		</div>
<!--End Contact Information-->

	</div>
<!--End Column 1-->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
      crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.js"integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"crossorigin="anonymous"></script>
      <link rel="stylesheet" href="index.css"> -->
    <title></title>
  </head>

  <body>

    <audio id="myAudio">
      <source src="messagesend.mp3" type="audio/mpeg">

    </audio>
      <!-- <div id="login" class="container"> -->
      <div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
          <!-- <div class="row  justify-content-center align-items-center d-flex text-center h-100"> -->
          <div class="panel panel-info">
                  <div class="col-12 col-md-8  h-50 ">
                      <h1 class="display-2  text-light mb-2 mt-5"><strong>Chat Room</strong> </h1>
                    </div>
                  </div>
            <br/>
      	     <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" method = "post">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">

                                    </div>
                                    <!--end of col-->
                                    <div class="col">

                                        <input id="name" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Enter Your Name here!" name = "name">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button id="frm"  name = "submit" class="btn btn-lg btn-primary" type="button">Enter Chat</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
      </div>
                    <br>
                    <br>


</div>


<div id="chat" class="container ">

  <h1 class="mt-5 text-center text-light display-1"><strong>S Chat</strong></h1>
<div class="ex1 p-3 border">

</div>
<div class="card-body row no-gutters align-items-center">
    <div class="col-auto">

    </div>
    <!--end of col-->
    <div class="col">

        <input id="msg_text" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Type Message Here!" name = "msg">
    </div>
    <!--end of col-->
    <div class="col-auto">
        <button id="msg_send"  name = "msg_text" class="ml-3 btn btn-lg btn-success" type="button">Send</button>
    </div>
    <!--end of col-->
</div>


</div>
<script src="ajax.js" type="text/javascript"></script>


  </body>
</html>


</div>
</div>
<!--End main body-->

<?php include('includes/footer.php') ?>