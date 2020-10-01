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
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$clientId = 1;


// $id = 3;

// $query = "SELECT * FROM artisan ORDER BY id DESC";
$query ='SELECT * FROM artisan WHERE artisanid=2';
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    $userRating = userRating($clientId, $row['artisanid'], $conn);
    $totalRating = totalRating($row['artisanid'], $conn);
    $outputString .= '
        <div class="row-item">
 <div class="row-title">' . $row['username'] . '</div> <div class="response" id="response-' . $row['artisanid'] . '"></div>
 <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row['artisanid'] . ',' . $userRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $row['artisanid'] . '_' . $count;
        
        if ($count <= $userRating) {
            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row['artisanid'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row['artisanid'] . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
 </ul>
 
 <p class="review-note">Total Reviews: ' . $totalRating . '</p>
 <p class="text-address">' . $row["address"] . '</p>
</div>
 ';
}
echo $outputString;