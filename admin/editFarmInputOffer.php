<?php include('../includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

if(isset($_SESSION["offer_id"])){
    $offer_id=$_SESSION["offer_id"];
}
else{
    $offer_id="";
}


$sql = "SELECT * FROM farm_input WHERE item_id='$offer_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title=$row["title"];
        $item_type=$row["item_type"];
        $description=$row["description"];
        $quantity=$row["quantity"];
        $selling_price=$row["selling_price"];
        }
} else {
    echo "0 results";
}

if(isset($_POST["editFarmInputOffer"])){
    $title=test_input($_POST["title"]);
    $item_type=test_input($_POST["item_type"]);
    $description=test_input($_POST["description"]);
    $quantity=test_input($_POST["quantity"]);
    $selling_price=test_input($_POST["selling_price"]);

    $sql = "UPDATE farm_input SET title='$title', item_type='$item_type', description='$description', quantity='$quantity', selling_price='$selling_price',e_username='$username', valid=1 WHERE item_id='$offer_id'";
  
    $result = $conn->query($sql);
    if($result==true){
        header("location: farmInputDetails.php");
    }
}

include('includes/header.php');

include('includes/admin-navbar.php');


 ?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Edit Farm Input Offer</h2>
                </div>

            <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-5">
                        <input placeholder="Give your offer a title" type="text" class="form-control" name="title" value="<?php echo $title; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Item Type</label>
                    <div class="col-sm-5">
                        <select name="item_type" class="form-control" id="" required="required">
                                <option value="<?php echo $item_type; ?>" disabled selected>Select Item Type</option>                
                                <option value="Maize">Maize</option>
                                <option value="Fertilizer">Fertilizer</option>
                                <option value="Farming tool">Farming tool</option>
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
                    <label class="col-sm-4 control-label">Quantity</label>
                    <div class="col-sm-5">
                        <input placeholder="Number of Bag" type="number" min="1" max="10000" class="form-control" name="quantity" value="<?php echo $quantity; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Selling Price per Item</label>
                    <div class="col-sm-5">
                        <input placeholder="Price" type="number" class="form-control" name="selling_price" value="<?php echo $selling_price; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="editFarmInputOffer" class="btn btn-info btn-lg">Edit</button>

                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>

