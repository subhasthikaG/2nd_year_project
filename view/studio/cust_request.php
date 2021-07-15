<?php 
require_once('../../inc/connection.php');
session_start();

$today = date("Y-m-d");
$s_id = $_SESSION['user_id'];

$query1 = "SELECT * FROM reserved_job WHERE studio_id = $s_id AND isplaced = 1 AND date = '$today'";
$result_set1 = mysqli_query($connection,$query1);

$query2 = "SELECT * FROM reserved_job WHERE studio_id = $s_id AND isplaced = 1 AND date > '$today'";
$result_set2 = mysqli_query($connection,$query2);

$query3 = "SELECT * FROM reserved_job WHERE studio_id = $s_id AND isplaced = 1 AND date < '$today'";
$result_set3 = mysqli_query($connection,$query3);
?>

<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Jobs</title>
	<link rel="stylesheet" type="text/css" href="../../css/studio/cust_request.css">
</head>
<body>
  <?php require_once('../../inc/stu_dash_navbar.php');?>

  <div class="secondary">
    <div class="btnbox">
	  <a href="#today">Today >></a>
	  <a href="#upcoming">Up Coming >></a>
	  <a href="#finish">Finished >></a>
	</div>
  </div>

  <div class="primary">
		  <div class="ro1">
			<h1 id="today" style="margin-left: 40px;">TODAY</h1>
			<div class="box">
				<?php
				echo "<table>";
				while($row1=mysqli_fetch_assoc($result_set1)){
					$c_id = $row1['c_id'];    
					$query11 = "SELECT *  FROM customer WHERE c_id = $c_id";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11);  
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='cust_request_view.php?job=$row1[job_id]&&status=1'>".$row1['job_id']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row1[job_id]&&status=1'>".$record11['first_name']." ".$record11['last_name']."</a></td>";
					echo "<td><a title='Booking Date' href='cust_request_view.php?job=$row1[job_id]&&status=1'>".$row1['date']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row1[job_id]&&status=1'>".$record11['email']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row1[job_id]&&status=1'>".$record11['tele_no']."</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				?>
				</div>
		  </div>

		  <div class="ro2">	
			<h1 id="upcoming" style="margin-left: 40px;">UP COMING</h1>
			<div class="box">
				<?php 
				echo "<table>";
				while($row2=mysqli_fetch_assoc($result_set2)){
					$c_id = $row2['c_id'];    
					$query11 = "SELECT *  FROM customer WHERE c_id = $c_id";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11); 
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='cust_request_view.php?job=$row2[job_id]&&status=2'>".$row2['job_id']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row2[job_id]&&status=2'>".$record11['first_name']." ".$record11['last_name']."</a></td>";
					echo "<td><a title='Booking Date' href='cust_request_view.php?job=$row2[job_id]&&status=2'>".$row2['date']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row2[job_id]&&status=2'>".$record11['email']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row2[job_id]&&status=2'>".$record11['tele_no']."</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				?>
				</div>
		  </div>	
			
		  <div class="ro3">	
			<h1 id="finished" style="margin-left: 40px;">FINISHED</h1>
			<div class="box">
				<?php 
				echo "<table>";
				while($row3=mysqli_fetch_assoc($result_set3)){
					$c_id = $row3['c_id'];
					$query11 = "SELECT *  FROM customer WHERE c_id = $c_id";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11); 
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='cust_request_view.php?job=$row3[job_id]&&status=3'>".$row3['job_id']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row3[job_id]&&status=3'>".$record11['first_name']." ".$record11['last_name']."</a></td>";
					echo "<td><a title='Booking Date' href='cust_request_view.php?job=$row3[job_id]&&status=3'>".$row3['date']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row3[job_id]&&status=3'>".$record11['email']."</a></td>";
					echo "<td><a href='cust_request_view.php?job=$row3[job_id]&&status=3'>".$record11['tele_no']."</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				?>
				</div>
		  </div>	
		</div>

  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>