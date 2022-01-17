<?php include('../includes/server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
}

$title=$item_type=$description=$quantity=$selling_price=$location="";

if(isset($_POST["postcontent"])){
    $title=test_input($_POST["title"]);
    $body=test_input($_POST["body"]);
    $category=test_input($_POST["category"]);

    $sql = "INSERT INTO postcontent (title, body, category, posted_by) VALUES ('$title', '$body','$category', '$username')";
    
    $result = $conn->query($sql);
    if($result==true){
        $_SESSION["offer_id"] = $conn->insert_id;
        // header("location: readPost.php");
        header("location: postDetails.php");
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
                    <h2>Write your posts here</h2>
                </div>

                <form id="registrationForm" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-5">
                        <input placeholder="Give your post a title" type="text" class="form-control" name="title" value="<?php echo $title; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Body</label>
                    <div class="col-sm-5">
                        <textarea placeholder="Give your post a title" type="text" class="form-control" name="body" value="<?php echo $title; ?>"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Category</label>
                    <div class="col-sm-5">
                        <select name="category" class="form-control" id="" required="required">
                                <option value="<?php echo $item_type; ?>" disabled selected>Select Item Type</option>                
                                <option value="White">Maize</option>
                                <option value="Yellow">Fertilizer</option>
                                <option value="Red">Farming tool</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="postcontent" class="btn btn-info btn-lg">Post</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


<?php include('includes/footer.php') ?>