<?php include('includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		header("location: farmerProfile.php");
	}
	else{
		header("location: farmerProfile.php");
	}
}
else{
    $username="";
}

include('includes/header.php');

include('includes/index-navbar.php');

 ?>

<!--Header and slider-->

<!--Header-->
<div class="row header1">
	<div class="col-lg-4">
		<div class="jumbotron">
			<div class="container text-center">
				<h1>Maize crop Management System</h1>
				<p>Remember, time is money. Use it properly. Do not waste your time thinking when others are getting things done here.</p>
				<a href="loginReg.php" class="btn btn-warning btn-lg">It's Free!! Join Now!!!</a>
			</div>
		</div>	
	</div>
<!--End Header-->

<!--slider-->
	<div class="col-lg-8">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="image/agri11.jpg" alt="Chania">
		      <div class="carousel-caption">
		        <h3>Work</h3>
		        <p>Work hard to be successful.</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="image/1farm.jpg" alt="Chania">
		      <div class="carousel-caption">
		        <h3>Time</h3>
		        <p>Do not waste your time.</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="image/prod2.jpg" alt="Flower">
		      <div class="carousel-caption">
		        <h3>Believe</h3>
		        <p>Always believe in yourself.</p>
		      </div>
		    </div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
</div>
<!--End slider-->
<!--End Header and slider-->



<?php  include('includes/footer.php');?>