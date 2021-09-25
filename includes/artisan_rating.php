<style>
/* body {
    width: 550px;
    font-family: arial;
} */

ul {
    margin: 0px;
    padding: 10px 0px 0px 0px;
}

li.star {
    list-style: none;
    display: inline-block;
    margin-right: 5px;
    cursor: pointer;
    color: #9E9E9E;
}

li.star.selected {
    color: #ff6e00;
}

.row-title {
    font-size: 20px;
    color: #00BCD4;
}

.review-note {
    font-size: 12px;
    color: #999;
    font-style: italic;
}
.row-item {
    margin-bottom: 20px;
    border-bottom: #F0F0F0 1px solid;
}
p.text-address {
    font-size: 12px;
}
</style>



<?php
require_once "functions.php";
// include('server.php');
// $query ="SELECT * FROM artisan WHERE username='$artisanName'";
// echo $_SESSION["Username"];

$userName = $_SESSION["Username"];

// $query ='SELECT * FROM artisan WHERE username= "$_SESSION["Username"]"   ';
// $query=mysqli_query($conn,   "SELECT * FROM artisan WHERE username= '$userName'   ");

// $query ="SELECT * FROM artisan WHERE username='$userName'";
$query ="SELECT * FROM freelancer WHERE username='$userName'";

  
$result = mysqli_query($conn, $query);

// $outputString = '';

foreach ($result as $row) {
    // $userRating = userRating($clientId, $row['artisanid'], $conn);
    // $totalRating = totalRating($row['artisanid'], $conn);

    // $artisanId = $row['artisanid'];
    $artisanId = $row['username'];
    // $username = $row['artisanid'];


}

// $result = mysqli_query($conn, $query);
// foreach ($result as $row) {
//     $artisanId = $row['artisanid'];

// }

// while($row=mysqli_fetch_array($query)){
//     $artisanId = $row['artisanid'];
// }



    // $artisanName =$row["f_username"];

// echo $artisanId;


// $query ="SELECT * FROM tbl_rating WHERE artisan_id='$artisanId'";

  
// $result = mysqli_query($conn, $query);

// // $outputString = '';

// foreach ($result as $row) {
//     // $userRating = userRating($clientId, $row['artisanid'], $conn);
//     // $totalRating = totalRating($row['artisanid'], $conn);

//     // $artisanId = $row['artisanid'];
//     $artisanId = $row['client_id'];


// }



$query ="SELECT * FROM tbl_rating WHERE artisan_id='$artisanId'";
  
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    $clientId = $row['client_id'];

    // $query ="SELECT * FROM client WHERE id='$clientId'";
    // $result = mysqli_query($conn, $query);
    // foreach ($result as $row) {
    //     // $people = array('Kevin', 'Jeremy', 'Sara');
    //     // $clientName = array('Kevin', 'Jeremy', 'Sara');

        
    //     $clientName = $row['username'];
    //     // $clientName = array('');
    // }

    // echo $clientName;


    // $userRating = userRating($clientId, $row['artisanid'], $conn);
    $userRating = userRating($clientId, $artisanId, $conn);
    $totalRating = totalRating($artisanId, $conn);
    $outputString .= '
        <div class="row-item">
 <div class="row-title">' . $userName . '</div> <div class="response" id="response-' . $artisanId . '"></div>
 <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $artisanId . ',' . $userRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $artisanId . '_' . $count;
        
        if ($count <= $userRating) {
            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $artisanId . ',' . $count . ');" onMouseOver="mouseOverRating(' . $artisanId . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
 </ul>
 
 <p class="review-note">Total Reviews: ' . $totalRating . '</p>
 <p class="review-note"> Name:' . $userName . '</p>
</div>
 ';
}
echo $outputString;