<?php
require_once('../../inc/connection.php');
session_start();

$studio_id = $_SESSION['studio_id'];
$userid = $_SESSION['user_id'];

if(isset($_POST['book'])){		//if a date is selected
  	
  $date = $_POST['date'];
  $choose_time = date('Y-m-d H:i:s');		//get current time	
	
  //select all
  $query2 = "SELECT * FROM reserved_job WHERE c_id = '$userid' AND studio_id = '$studio_id' AND date = '$date' AND isplaced=0";
  $result_set2 = mysqli_query($connection,$query2);

  //delete if a job is already there
  if(mysqli_num_rows($result_set2)==1){
	$query = "DELETE FROM reserved_job WHERE c_id = '$userid' AND studio_id = '$studio_id' AND date = '$date'";
	$result_set = mysqli_query($connection,$query);
  }

  //create a new job index
  $query = "INSERT INTO reserved_job (c_id,studio_id,date,choose_time) VALUES ('$userid','$studio_id','$date','$choose_time')";
  $result_set = mysqli_query($connection,$query);
  $query5 = "SELECT job_id FROM reserved_job WHERE c_id = '$userid' AND studio_id = '$studio_id' AND date = '$date'";
  $result_set5 = mysqli_query($connection,$query5);
  $row5 = mysqli_fetch_assoc($result_set5);
  $_SESSION['job'] = $row5['job_id'];	
  
  //select the date of the job
  $job = $_SESSION['job'];
  $query111 = "SELECT date FROM reserved_job WHERE job_id='$job'";
  $result_set111 = mysqli_query($connection,$query111);
  $row111 = mysqli_fetch_assoc($result_set111);
  $date = $row111['date'];
}
$query111 = "SELECT date FROM reserved_job WHERE job_id='$job'";
$result_set111 = mysqli_query($connection,$query111);
$row111 = mysqli_fetch_assoc($result_set111);
$date = $row111['date'];
$job = $_SESSION['job'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Select Services</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/select_service.css">
</head>
<body>
  <?php require_once('../../inc/cust_dash_navbar.php');?>
  
  <div class="row1">
	<div class="col1">
		<h1><?php echo $date;?><br>SELECT SERVICES<br>>></h1>
	</div>  
	<div class="col2">
	  <form action="select_service.php" method="post">
		<div class="box">
		<?php
		$query1 = "SELECT * FROM studio_service WHERE studio_id = $studio_id";
		$result_set1 = mysqli_query($connection,$query1);
		while($row1=mysqli_fetch_assoc($result_set1)){
			$ser = $row1['service_name'];
			echo "<label class='cont'>$ser";
			echo "<input type='checkbox' name='$ser'>";
			echo "<span class='checkmark'></span>";
			echo "</label>";	  
		}
		?>
		</div>
		<button type="submit" name="sservice">NEXT</button>	
	  </form>
	</div>
  </div>

  <?php
  if(isset($_POST['sservice'])){

	//get choose_time (time job was placed)
	$query55 = "SELECT choose_time FROM reserved_job WHERE job_id = $job";
	$result_set55 = mysqli_query($connection,$query55);
	$record55 = mysqli_fetch_assoc($result_set55);

	$choosetime = $record55['choose_time'];	
	$cutoff = date( "Y-m-d H:i:s", strtotime( $choosetime ) + 900);       //cutoff time (choose time+ 15min)
	$cur_time = date("Y-m-d H:i:s");		//current time

	$cur_time2 = strtotime($cur_time);
	$cutoff2 = strtotime($cutoff);

	//check if the cutoff time passed
	
	//if yes, release temporirly blocking
	if($cur_time2>$cutoff2){
	  $query57 = "UPDATE reserved_job SET temp_blocked = 0 WHERE job_id = '$job'";
	  $result_set57 = mysqli_query($connection,$query57); 	
	  header("Location: time_out.php");
	}
 
	else{
		$query11 = "SELECT * FROM studio_service WHERE studio_id = $studio_id";
		$result_set11 = mysqli_query($connection,$query11);
		$serlist = [];
		while($row11=mysqli_fetch_assoc($result_set11)){
		  array_push($serlist,$row11);	
		}
	
		$ischecked = 0;  
		for($i=0;$i<count($serlist);$i++){
		  $ser = $serlist[$i]['service_name'];
		  if(isset($_POST[$ser])){
			$ischecked = 1;
			break;  	  
		  }  	
		}
		if($ischecked==1){	
		  for($j=0;$j<count($serlist);$j++){
			$ser = $serlist[$j]['service_name'];
			$chrg = $serlist[$j]['service_charge'];	
			$query6 = "SELECT * FROM reserved_services WHERE job_id = '{$job}' AND service_name = '{$ser}'";
			$result_set6 = mysqli_query($connection,$query6);
			
			if(mysqli_num_rows($result_set6)==0){
			  if(isset($_POST[$ser])){	
				$query8 = "INSERT INTO reserved_services (job_id,service_name,charge) VALUES ('$job','$ser','$chrg')";
				$result_set8 = mysqli_query($connection,$query8);    	
			  }	
			}
			else{
			  if(!isset($_POST[$ser])){
				$query8 = "DELETE FROM reserved_services WHERE job_id='{$job}' AND service_name = '{$ser}'";
				$result_set8 = mysqli_query($connection,$query8); 	  
			  }	
			}  	
		  }
		  header("Location: select_equipments.php"); 	
		}
		else{
		  header("Location: select_service.php");  	
		}	
	}
  }	
  ?>
  
  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>