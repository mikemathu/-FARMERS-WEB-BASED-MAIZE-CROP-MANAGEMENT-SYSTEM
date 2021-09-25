<?php
// require_once ('db.php');
include('includes/server.php');


// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
// $clientId = 1;

// Get ClientID
$clientName = $_SESSION["Username"];

$checkClientID = mysqli_query
($conn, "SELECT * FROM client WHERE username= '$clientName' ");

if(mysqli_num_rows($checkClientID) > 0){
    $row   = mysqli_fetch_row($checkClientID);

     $clientId = $row[0];
   }

if (isset($_POST["index"], $_POST["artisan_id"])) {
    
    $artisanId = $_POST["artisan_id"];
    // echo $artisanId;
    $rating = $_POST["index"];
    
    $checkIfExistQuery = "select * from tbl_rating where client_id = '" . $clientId . "' and artisan_id = '" . $artisanId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO tbl_rating(client_id,artisan_id, rating) VALUES ('" . $clientId . "','" . $artisanId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}