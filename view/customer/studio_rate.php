<?php
require_once('../../inc/connection.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/customer/rates.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rate</title>
</head>
<body>
<?php require_once('../../inc/cust_dash_navbar.php');?> 
   
    
    <div class="row">
        <div class="container">    
            <h2><center>Review Studio</center></h2>
            <div id="details">
                <div id="col1"> 
                    <?php                    
                        if(isset($_GET['studio_id']) ){
                            $studio_id=$_GET['studio_id'];
                            $query="SELECT * from studio WHERE studio_id=$studio_id";
                            $result_set=mysqli_query($connection,$query);
                            $row=mysqli_fetch_assoc($result_set);                            
                        }
                        else{
                            echo "no";
                        }

                     
                         echo "<h2>$row[studio_name]<br>$row[distric]</h2>";
                        
                    ?>
                </div>
                <div id="col2">
                    <?php
                         echo "<img src='../../img/studio/$row[profile]' height='150' width='150'>";
                        
                    ?>
                </div>
            </div>
            
            <!-- <div class="star" style="color: red;"> -->
                <form action="../../controller/customer/rate_controller.php?studio_id=<?php echo $studio_id?>" method="post"  class="">
                    <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                            <div class="textfield"><input type="text" name="comment"></div>
                            <div class="btn-submit"><input type="submit" value="Submit" name="submit"></div>
                    </div>
                    
                    
                    
                </form>
            <!-- </div> -->

        </div> 
    </div>
   
  
    
      
 

</body>
</html>