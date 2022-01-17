<?php include('includes/server.php');
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
}

if(isset($_SESSION["msgRcv"])){
    $msgRcv=$_SESSION["msgRcv"];
}

if(isset($_POST["send"])){
    $msgTo=$_POST["msgTo"];
    $msgBody=$_POST["msgBody"];
    $sql = "INSERT INTO message (sender, receiver, msg) VALUES ('$username', '$msgTo', '$msgBody')";
    $result = $conn->query($sql);
    if($result==true){
        header("location: message.php");
    }
}

include('includes/header.php');

include('includes/farmer-navbar.php');


 ?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Write Message</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">To</label>
                    <div class="col-sm-8">
                        <input  type="text" class="form-control" name="msgTo" value="<?php 
                       
                        echo $msgRcv;
                         ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Message Body</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="12" name="msgBody"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="send" class="btn btn-info btn-lg">Send Message</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php');?>


