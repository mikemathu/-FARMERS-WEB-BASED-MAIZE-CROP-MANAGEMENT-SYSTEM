<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_SESSION["c_letter"])){
	$c_letter=$_SESSION["c_letter"];
}

include('includes/header.php');

include('includes/client-navbar.php');


 ?>



<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Cover Letter</h2>
                </div>
                <div class="page-header">
                    <h4><?php echo nl2br($c_letter); ?></h4>
                </div>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>