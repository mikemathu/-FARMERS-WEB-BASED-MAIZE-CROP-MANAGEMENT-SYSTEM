
<?php 
include('includes/header.php'); ?>


<script>
body {
    width: 550px;
    font-family: arial;
}

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
</script>


<body onload="showRestaurantData('getRatingData.php')">
    <div class="container">
    <h2>Artisan Review</h2>
        <span id="restaurant_list"></span>
        <a href="offerDetails.php" class="btn btn-primary">Go back</a>
    </div>
</body>


<script type="text/javascript">

    function showRestaurantData(url)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("restaurant_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();

    } 

    function mouseOverRating(artisanId, rating) {

        resetRatingStars(artisanId)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = artisanId + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";

        }
    }

    function resetRatingStars(artisanId)
    {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = artisanId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }

   function mouseOutRating(artisanId, userRating) {
	   var ratingId;
       if(userRating !=0) {
    	       for (var i = 1; i <= userRating; i++) {
    	    	      ratingId = artisanId + "_" + i;
    	          document.getElementById(ratingId).style.color = "#ff6e00";
    	       }
       }
       if(userRating <= 5) {
    	       for (var i = (userRating+1); i <= 5; i++) {
	    	      ratingId = artisanId + "_" + i;
	          document.getElementById(ratingId).style.color = "#9E9E9E";
	       }
       }
    }

    function addRating (artisanId, ratingValue) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200) {

                    showRestaurantData('getRatingData.php');
                    
                    if(this.responseText != "success") {
                    	   alert(this.responseText);
                    }
                }
            };

            xhttp.open("POST", "insertRating.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var parameters = "index=" + ratingValue + "&artisan_id=" + artisanId;
            xhttp.send(parameters);
    }
</script>


<?php
