<?php
require_once('../../inc/connection.php');
session_start(); 

$today = date("Y-m-d");
$cus_id = $_SESSION['user_id'];

$query1 = "SELECT * FROM reserved_job WHERE c_id = $cus_id AND isplaced = 1 AND date = '$today'";
$result_set1 = mysqli_query($connection,$query1);

$query2 = "SELECT * FROM reserved_job WHERE c_id = $cus_id AND isplaced = 1 AND date > '$today'";
$result_set2 = mysqli_query($connection,$query2);

$query3 = "SELECT * FROM reserved_job WHERE c_id = $cus_id AND isplaced = 1 AND date < '$today'";
$result_set3 = mysqli_query($connection,$query3);
?>
 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>JOBS</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/pendings.css">
</head>  
<body>
		<?php require_once('../../inc/cust_dash_navbar.php');?>
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
					$sid =$row1['studio_id'];  
					$query11 = "SELECT *  FROM studio WHERE studio_id = $sid";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11);  
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='view_jobs.php?job=$row1[job_id]&&status=1'>".$row1['job_id']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row1[job_id]&&status=1'>".$record11['studio_name']."</a></td>";
					echo "<td><a title='Booking Date' href='view_jobs.php?job=$row1[job_id]&&status=1'>".$row1['date']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row1[job_id]&&status=1'>".$record11['distric']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row1[job_id]&&status=1'>".$record11['s_email']."</a></td>";
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
					$sid =$row2['studio_id'];  
					$query11 = "SELECT *  FROM studio WHERE studio_id = $sid";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11);  
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='view_jobs.php?job=$row2[job_id]&&status=2'>".$row2['job_id']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row2[job_id]&&status=2'>".$record11['studio_name']."</a></td>";
					echo "<td><a title='Booking Date' href='view_jobs.php?job=$row2[job_id]&&status=2'>".$row2['date']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row2[job_id]&&status=2'>".$record11['distric']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row2[job_id]&&status=2'>".$record11['s_email']."</a></td>";
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
					$sid =$row3['studio_id'];  
					$query11 = "SELECT *  FROM studio WHERE studio_id = $sid";
					$result_set11 = mysqli_query($connection,$query11);
					$record11 = mysqli_fetch_assoc($result_set11);  
					
					echo "<tr>";
					echo "<td><a title='Job ID' href='view_jobs.php?job=$row3[job_id]&&status=3'>".$row3['job_id']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row3[job_id]&&status=3'>".$record11['studio_name']."</a></td>";
					echo "<td><a title='Booking Date' href='view_jobs.php?job=$row3[job_id]&&status=3'>".$row3['date']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row3[job_id]&&status=3'>".$record11['distric']."</a></td>";
					echo "<td><a href='view_jobs.php?job=$row3[job_id]&&status=3'>".$record11['s_email']."</a></td>";
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