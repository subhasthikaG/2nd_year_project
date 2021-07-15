<?php
require_once('../../inc/connection.php');
session_start(); 

if(isset($_GET['job'])){
  $job = $_GET['job'];
  $_SESSION['job_id']=$job;

  $query1 = "SELECT * FROM reserved_job WHERE job_id = $job";
  $result_set1 = mysqli_query($connection,$query1);
  $record1 = mysqli_fetch_assoc($result_set1);
  
  $studio_id = $record1['studio_id'];
  
  $query2 = "SELECT * FROM studio WHERE studio_id = $studio_id";
  $result_set2 = mysqli_query($connection,$query2);
  $record2 = mysqli_fetch_assoc($result_set2);

  $query3 = "SELECT * FROM reserved_services WHERE job_id = $job";
  $result_set3 = mysqli_query($connection,$query3);

  $query4 = "SELECT * FROM reserved_audio_gear WHERE job_id = $job";
  $result_set4 = mysqli_query($connection,$query4);
}

?>

<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/view_pending.css">
</head>
<body>
  <?php require_once('../../inc/cust_dash_navbar.php');?>
	
  <div class="row">
    <div class="container">
      <div id="details">
      <div id="col1">
        <?php
        echo "<p>$record1[choose_time]</p>";
        echo "<p>Job ID: $job</p>";
        echo "<p>$record2[s_email]</p>";
        echo "<p>Studio ID: $record2[studio_id]</p>";
        echo "<p>Booking Date: <b>$record1[date]</b></p>";
        ?>
      </div>
      <div id="col2">
        <?php
        echo "<h2>$record2[studio_name]<br>$record2[distric]</h2>";
        ?>
      </div>
      <div id="col3">
        <?php
        echo "<img src='../../img/studio/$record2[profile]' height='150' width='150'>";
        ?>
      </div>  
      </div>
      
      <div id="services">
        <h3>SERVICES</h3>
          <?php
            $total = 0;
            echo "<p>";
            while($record3 = mysqli_fetch_assoc($result_set3)){
              echo "$record3[service_name], ";
              $total = $total + $record3['charge'];  
            }
            echo "</p>";
          ?>
          <h3>ADDITIONAL EQUIPMENTS</h3>  
          <?php
            echo "<p>";
            while($record4 = mysqli_fetch_assoc($result_set4)){
              echo "$record4[name], ";
              $total = $total + $record4['charge'];    
            }
            echo "</p>";
          ?>
          <h3>TOTAL FEE</h3>
            <?php
              echo "<p>$total LKR</p>";
            ?>  
      </div>

      <div id="buttons">        
      <?php
            if(isset($_GET['status'])){
              if($_GET['status']==1){
                echo "<a href='#'>Message</a>";
                // echo "<a href='#'>Complaint</a>";
              }
              if($_GET['status']==2){
                echo "<a href='cust_chat.php?studio_id=$studio_id'>Message</a>";
                // echo "<a href='#'>Complaint</a>";
              }
              if($_GET['status']==3){
                if($record1['rated']==0){
                  echo "<a href='studio_rate.php?studio_id=$studio_id'>Rate</a>";
                }
                echo "<a href='cust_complaint.php?studio_id=$studio_id'>Complaint</a>";
              }
            }
          ?>
      </div>    
	  </div>
  </div>	

  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>