<?php include('../includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

$title=$item_type=$description=$quantity=$selling_price=$location="";

if(isset($_POST["postFarmInput"])){
    $title=test_input($_POST["title"]);
    $item_type=test_input($_POST["item_type"]);
    $description=test_input($_POST["description"]);
    $quantity=test_input($_POST["quantity"]);
    $selling_price=test_input($_POST["selling_price"]);

    $sql = "INSERT INTO farm_input (item_type,title, description,quantity, selling_price, e_username, valid) VALUES ('$item_type','$title', '$description','$quantity','$selling_price', '$username',1)";
    
    $result = $conn->query($sql);
    if($result==true){
        $_SESSION["offer_id"] = $conn->insert_id;
        header("location: farmInputDetails.php");
    } else {
        echo 'nothing';
    }
}

include('includes/header.php');

include('includes/admin-navbar.php');

 ?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Post Here Availabe Farm outputs</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-5">
                        <input placeholder="Give your post a title" type="text" class="form-control" name="title" value="<?php echo $title; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Item Type</label>
                    <div class="col-sm-5">
                        <select name="item_type" class="form-control" id="" required="required">
                                <option value="<?php echo $item_type; ?>" disabled selected>Select Item Type</option>                
                                <option value="White">Maize</option>
                                <option value="Yellow">Fertilizer</option>
                                <option value="Red">Farming tool</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Description <br>
                    <small disabled>(Optional)</small> </label>
                    
                    <div class="col-sm-5">
                        <input placeholder="Description" type="text" class="form-control" name="description" value="<?php echo $description; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Quantity/<br/> Amount</label>
                    <div class="col-sm-5">
                        <input placeholder="Quantity/Amount" type="number" min="1" max="10000" class="form-control" name="quantity" value="<?php echo $quantity; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Selling Price per Item</label>
                    <div class="col-sm-5">
                        <input placeholder="Price" min="1" type="number" class="form-control" name="selling_price" value="<?php echo $selling_price; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="postFarmInput" class="btn btn-info btn-lg">Post</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>