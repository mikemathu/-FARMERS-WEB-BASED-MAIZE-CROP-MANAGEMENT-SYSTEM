<!--Navbar menu-->
<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
	<div class="container">
		<div class="navber-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">MCMS</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="marketRequests.php">Market Orders</a></li>
				<li><a href="farmInputs.php">Farm Inputs </a></li>
				<li><a href="allClients.php">Clients</a></li>
				<li><a href="contactAdmin.php">Contact Admin</a></li>
				<li><a href="readposts.php">Blog</a></li>
				
				<li class="dropdown" style="background:#000;padding:0 20px 0 20px;">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?>
			        </a>
			        <ul class="dropdown-menu list-group list-group-item-info">
			        	<a href="farmerProfile2.php" class="list-group-item"><span class="glyphicon glyphicon-home"></span>  View profile</a>
			          	<a href="editfarmer.php" class="list-group-item"><span class="glyphicon glyphicon-inbox"></span>  Edit Profile</a>
					  	<a href="farmerMessages.php" class="list-group-item"><span class="glyphicon glyphicon-envelope"></span>  Messages</a> 
					  	<a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-ok"></span>  Logout</a>
			        </ul>
			    </li>
			</ul>
		</div>		
	</div>	
</nav>
<!--End Navbar menu-->