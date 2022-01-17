<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="includes/fontawesome.css">
      <link rel="stylesheet" href="index.css">
      <script src="includes/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="includes/bootstrap.min.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="awesome/css/fontawesome-all.min.css">
    <style>
	body{padding-top: 3%;margin: 0;}
	.header1{background-color: #EEEEEE;padding-left: 1%;}
	.header2{padding:20px 40px 20px 40px;color:#fff;}
	.card{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background:#fff}

</style>
    <title></title>
  </head>

  <body>
    <?php 
    include('includes/server.php');
    if(isset($_SESSION["Username"])){
      $username=$_SESSION["Username"];
    }
    else{
      $username="";
    }
    
    include('includes/farmer-navbar.php');

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
    
     ?>

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
		
		</div>
<!--End Contact Information-->

	</div>
<!--End Column 1-->
 

    <audio id="myAudio">
      <source src="messagesend.mp3" type="audio/mpeg">

    </audio>
      <div id="login" class="card">
          <div class="row  justify-content-center align-items-center d-flex text-center h-100">
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
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button id="frm"  name = "submit" class="btn btn-lg btn-primary enter" type="button">Open Chat</button>
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


<div id="chat" >

  <h1 class="mt-5 text-center text-light display-1"><strong>Chat</strong></h1>
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
