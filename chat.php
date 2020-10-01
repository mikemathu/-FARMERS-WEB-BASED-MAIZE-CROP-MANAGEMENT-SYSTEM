<?php


$checkartisanID = mysqli_query
($conn, "SELECT * FROM artisan WHERE username= '$username' ");

if(mysqli_num_rows($checkartisanID) > 0){
    $row   = mysqli_fetch_row($checkartisanID);

     $artisanid = $row[0];
   }


$query=mysqli_query($conn, "select * from `chat` left join `artisan` on artisan.artisanid=chat.artisanid order by chat_date asc") or die(mysqli_error());


while($row=mysqli_fetch_array($query)){
    ?>	
    <div>
        <img src="<?php if(empty($row['photo'])){echo "image/profile.jpg";}else{echo 'image/'.$row['photo'];} ?>" style="height:30px; width:30px; position:relative; top:15px; left:10px;">
        <span style="font-size:10px; position:relative; top:7px; left:15px;"><i><?php echo date('M-d-Y h:i A',strtotime($row['chat_date'])); ?></i></span><br>
        <span style="font-size:11px; position:relative; top:-2px; left:50px;"><strong><?php        
        // echo $row['username'];

        if($row['username'] == $username){
            echo 'You';
        } else{
            echo $row['username'];
        }
        
        
        ?></strong>: <?php echo $row['message']; ?></span><br>
    </div>
    <div style="height:5px;"></div>
    <?php
    }
    ?>


    <?php
   
     
        if(isset($_POST['send_msg'])){
            if(!empty($_POST['chat_msg']))	{
 
 $msg=$_POST['chat_msg'];

 mysqli_query($conn,"insert into `chat` (message, artisanid, chat_date) values ('$msg' , 
     '$artisanid' ,
     NOW())
  ")
 or 
 die(mysqli_error());
       }
   
}