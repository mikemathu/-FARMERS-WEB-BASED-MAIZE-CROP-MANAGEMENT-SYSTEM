<?php include('includes/server.php');


include('includes/header.php');

include('includes/loginReg-navbar.php');

 ?>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="page-header">
                <h2>Login</h2>
            </div>
            <form id="loginForm" method="post" class="form-horizontal">
                <div style="color:red;">
                    <p><?php echo $errorMsg; ?></p>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="username" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Usertype</label>
                    <div class="col-sm-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="usertype" value="farmer" /> Farmer
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="usertype" value="client" /> Client/ Buyer
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                        <button type="submit" name="login" class="btn btn-info btn-lg">Login</button>
                    </div>
                </div>
                
            </form>

            <p>You have no account? You can Register <a href="farmerReg.php">here</a> as a Farmer  or <a href="clientReg.php">here</a> as a Client. </p> 
        </div>


    </div>
</div>


<?php include('includes/footer.php'); ?>