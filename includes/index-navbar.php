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
			<a href="loginReg.php" class="btn btn-info navbar-btn navbar-right">Login</a>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="admin/login.php">Admin</a></li>


				<li class="dropdown" >
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration
			        </a>
			        <ul class="dropdown-menu list-group list-group-item-info">
						<a href="farmerReg.php" class="list-group-item">Farmer Registration</a>
						<a href="clientReg.php" class="list-group-item">Client Registration</a>
			        </ul>
			    </li>
			</ul>		
		</div>		
	</div>	
</nav>
<!--End Navbar menu-->