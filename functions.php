<?php

function userRating($clientId, $artisanId, $conn)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM tbl_rating WHERE client_id = '" . $clientId . "' and artisan_id = '" . $artisanId . "'";
    $total_row = 0;
    
    if ($result = mysqli_query($conn, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf
    
    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}
 // endFunction
function totalRating($artisanId, $conn)
{
    $totalVotesQuery = "SELECT * FROM tbl_rating WHERE artisan_id = '" . $artisanId . "'";
    
    if ($result = mysqli_query($conn, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf
    
    return $rowCount;
}//endFunction
