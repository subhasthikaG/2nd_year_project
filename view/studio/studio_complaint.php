<?php 
require_once('../../inc/connection.php');
session_start();
if(isset($_GET['c_id'])){
  $c_id=$_GET['c_id'];
  //echo "yes";
}
else{
   echo "no";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Studio-Complaint</title>
    <link rel="stylesheet" href="../../css/customer/complaint.css">
  </head>
  <body >
  <?php require_once('../../inc/stu_dash_navbar.php');?>
    

    <div class="center">
      <h1 style="color:gray;">Add your complaint</h1>

      <form method="post" action="../../controller/customer/cust_complaint_controller.php?c_id=<?php echo $c_id?>">
        <div class="textarea">         
         
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
          <input  type="submit" value="submit" name="submit_studio">
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

