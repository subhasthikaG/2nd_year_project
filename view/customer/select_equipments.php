<?php 
require_once('../../inc/connection.php');
session_start();
$studio_id = $_SESSION['studio_id'];
$job = $_SESSION['job'];
$query111 = "SELECT date FROM reserved_job WHERE job_id='$job'";
$result_set111 = mysqli_query($connection,$query111);
$row111 = mysqli_fetch_assoc($result_set111);
$date = $row111['date'];
?>

<?php
  if(isset($_POST['seleqp'])){
	
	$query55 = "SELECT choose_time FROM reserved_job WHERE job_id = $job";
	$result_set55 = mysqli_query($connection,$query55);
	$record55 = mysqli_fetch_assoc($result_set55);

	$choose_time = $record55['choose_time'];	
	$cutoff = date( "Y-m-d H:i:s", strtotime( $choose_time ) + 900);
	$cur_time = date("Y-m-d H:i:s");

	$cur_time2 = strtotime($cur_time);
	$cutoff2 = strtotime($cutoff);

	if($cur_time2>$cutoff2){
	  $query57 = "UPDATE reserved_job SET temp_blocked = 0 WHERE job_id = '$job'";
	  $result_set57 = mysqli_query($connection,$query57); 	
	  header("Location: time_out.php");	
	}

	else{
	  $query11 = "SELECT * FROM studio_audio_gear WHERE studio_id = $studio_id";
	  $result_set11 = mysqli_query($connection,$query11);
	  $eqplist = [];
	  while($row11=mysqli_fetch_assoc($result_set11)){
	   array_push($eqplist,$row11);	
	  }
		
	  $ischecked = 0;  
	  for($i=0;$i<count($eqplist);$i++){
		$eqpid = $eqplist[$i]['audio_id']; 	
		if(isset($_POST[$eqpid])){
		  $ischecked = 1;
		  break;  	  
		}  	
	  }
	
	  if($ischecked==1){
		for($j=0;$j<count($eqplist);$j++){
		  $eqpid = $eqplist[$j]['audio_id'];
		  $chrg = $eqplist[$j]['charge'];
		  $audn = $eqplist[$j]['name'];
		  $query6 = "SELECT * FROM reserved_audio_gear WHERE job_id = '{$job}' AND audio_id = '{$eqpid}'";
		  $result_set6 = mysqli_query($connection,$query6);
			
		  if(mysqli_num_rows($result_set6)==0){
			if(isset($_POST[$eqpid])){	
			  $query8 = "INSERT INTO reserved_audio_gear (audio_id,job_id,charge,name) VALUES ('$eqpid','$job','$chrg','$audn')";
			  $result_set8 = mysqli_query($connection,$query8);    	
			}		
		  }
		  else{
			if(!isset($_POST[$eqpid])){
			  $query8 = "DELETE FROM reserved_audio_gear WHERE job_id='{$job}' AND audio_id = '{$eqpid}'";
			  $result_set8 = mysqli_query($connection,$query8); 	  
			}	
		  } 
		} 
	  }
	  header("Location: cart.php");  
	  }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Additional Equipments</title>
    <link rel="stylesheet" type="text/css" href="../../css/customer/select_service.css">
	<style>
	  .box{
	    width: 70%;
		margin-left: 15%;  
	    height: 350px; 
		}
	  .col1{
	    padding-top: 200px;	
	    }			
	</style>
</head>
<body>
<?php require_once('../../inc/cust_dash_navbar.php');?>
  
  <div class="row1">
	<div class="col1">
		<h1><?php echo $date;?><br>SELECT ADDITIONAL EQUIPMENTS<br>>></h1>
	</div>  
	<div class="col2">
	  <form action="select_equipments.php" method="post">
		<div class="box">
		<?php
		$query = "SELECT * FROM studio_audio_gear WHERE studio_id = $studio_id";
		$result_set = mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($result_set)){
			$eqpid = $row['audio_id'];
			echo "<label class='cont'>$row[name]";
			echo "<input type='checkbox' name='$eqpid'>";
			echo "<span class='checkmark'></span>";
			echo "</label>";	  
		}
		?>
		</div>
		<button type="submit" name="seleqp">NEXT</button>	
	  </form>
	</div>
  </div>
  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>