<?php 
require_once('../../inc/connection.php');
session_start();

if(isset($_GET['job'])){
	$job = $_GET['job'];
	
	$query1 = "SELECT * FROM reserved_job WHERE job_id = $job";
	$result_set1 = mysqli_query($connection,$query1);
	$record1 = mysqli_fetch_assoc($result_set1);
	
	$c_id = $record1['c_id'];
	
	$query2 = "SELECT * FROM customer WHERE c_id = $c_id";
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
	<title>Job View</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/view_pending.css">
</head>
<body>
  <?php require_once('../../inc/stu_dash_navbar.php');?>
    
  <div class="row">
    <div class="container">
      <div id="details">
      <div id="col1">
        <?php
        echo "<p>$record1[choose_time]</p>";
        echo "<p>Job ID: $job</p>";
        echo "<p>$record2[email]</p>";
		echo "<p>$record2[tele_no]</p>";
        echo "<p>Customer ID: $record2[c_id]</p>";
        echo "<p>Booking Date: <b>$record1[date]</b></p>";
        ?>
      </div>
      <div id="col2">
        <?php
        echo "<h2>$record2[first_name] $record2[last_name]</h2>";
        ?>
      </div>
      <div id="col3">
        <?php
        echo "<img src='../../img/customer/$record2[image]' height='150' width='150'>";
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
                echo "<a href='studio_chat.php?c_id=$c_id'>Message</a>";
                // echo "<a href='#'>Complaint</a>";
              }
              if($_GET['status']==2){
                echo "<a href='studio_chat.php?c_id=$c_id'>Message</a>";
                // echo "<a href='#'>Complaint</a>";
              }
              if($_GET['status']==3){
                echo "<a href='studio_complaint.php?c_id=$c_id'>Complaint</a>";
              }
            }
          ?>
      </div>    
	  </div>
  </div> 

  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>