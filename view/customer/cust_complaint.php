<?php 
require_once('../../inc/connection.php');
session_start();
if(isset($_GET['studio_id'])){
  $studio_id=$_GET['studio_id'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Customer-Complaint</title>
    <link rel="stylesheet" href="../../css/customer/complaint.css">
  </head>
  <body style="background-color: #004882;background: linear-gradient(rgba(225,225,225,0.5),rgba(227,168,155,0.7));">
  <?php require_once('../../inc/cust_dash_navbar.php');?>
    

    <div class="center">
      <h1 style="color:gray;">Add your complaint</h1>

      <form method="post" action="../../controller/customer/cust_complaint_controller.php?studio_id=<?php echo $studio_id?>">
        <div class="textarea">         
          <!-- <input type="text" name="complaint" placeholder="Type here"> -->
          <textarea id="complaint" name="complaint" rows="10" cols="50"></textarea>
  
        </div>
        <div class="error">
            <?php
                if(isset($_GET['errors']) && !empty($_GET['errors'])){
                    $str_arr = unserialize(urldecode($_GET['errors']));
                     foreach($str_arr as $error){
                        echo $error . '<br>';
                    }
                }
            ?>
        </div>
        <div class="button">
          <input  type="submit" value="submit" name="submit_customer"> 
        </div>
	  </form>
	  <div class="sent">
            <?php
                if(isset($_GET['success'])){
					echo $_GET['success'];
				}
                   
                
            ?>
        </div>
    </div>
  </body>
</html>

