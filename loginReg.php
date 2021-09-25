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
                        <input type="text" class="form-control" name="username" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" />
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
        </div>
        <div class="col-md-6 col-md-offset-1">
            <div class="page-header">
                <h2>Register</h2>
            </div>

            <form id="registrationForm" method="post" class="form-horizontal">
                <div style="color:red;">
                    <p><?php echo $errorMsg2; ?></p>
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Email address</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Retype Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="repassword" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact no.</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="contactNo" value="<?php echo $contactNo; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">ID Card no.</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="IdCardNo" value="<?php echo $IdCardNo; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Farm Location</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="farm_location" value="<?php echo $farm_location; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Farm Size in hectare(ha)</label>
                    <div class="col-sm-5">

                        <select  name="farm_size" class="form-control" id="doctor" required="required">
                            <option value="<?php echo $farm_size; ?>" disabled selected>Select Farm Size in hectare(ha)</option>                
                            <option value="<0.5">Less than 1/2 ha</option>
                            <option value="0.5">1/2 ha</option>
                            <option value="1">1 ha</option>
                            <option value="2">2 ha</option>
                            <option value="3">3 ha</option>
                            <option value="4">4 ha</option>
                            <option value="5">5 ha</option>
                            <option value=">5">More than 5 ha</option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Farm Soil Type</label>
                    <div class="col-sm-5">

                        <select name="soil_type" class="form-control" id="doctor" required="required">
                            <option value="<?php echo $soil_type; ?>" disabled selected>Select Soil Type in your Farm</option>                
                            <option value="Not Yet Tested">Not Yet Tested</option>
                            <option value="Sand">Sand</option>
                            <option value="clay">clay</option>
                            <option value="loam">loam</option>
                            <option value="sandy-clay">sandy-clay</option>
                            <option value="sandy-loam">sandy-loam</option>
                            <option value="silty-clay">silty-clay</option>
                            <option value="other">Other</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="male" /> Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="female" /> Female
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="other" /> Other
                            </label>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Date of birth</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="birthdate" value="<?php echo $birthdate; ?>" placeholder="YYYY-MM-DD" />
                    </div>
                </div> -->

                <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" />
                    </div>
                </div> -->

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
                        <button type="submit" name="register" class="btn btn-info btn-lg">Sign up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>






<?php include('includes/footer.php'); ?>





