<?php 

require_once('../../inc/connection.php');
session_start();
$studio_id = $_SESSION['studio_id'];
$job = $_SESSION['job'];

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

$query55 = "SELECT choose_time FROM reserved_job WHERE job_id = $job";
$result_set55 = mysqli_query($connection,$query55);
$record55 = mysqli_fetch_assoc($result_set55);

$choosetime = $record55['choose_time'];	
$cutoff = date( "Y-m-d H:i:s", strtotime( $choosetime ) + 900);
$cur_time = date("Y-m-d H:i:s");

$cur_time2 = strtotime($cur_time);
$cutoff2 = strtotime($cutoff);

if($cur_time2>$cutoff2){
  $query57 = "UPDATE reserved_job SET temp_blocked = 0 WHERE job_id = '$job'";
  $result_set57 = mysqli_query($connection,$query57); 	
  header("Location: time_out.php");	
}

$query = "SELECT paypal FROM studio WHERE studio_id = $studio_id";
$result_set = mysqli_query($connection,$query);
$record = mysqli_fetch_assoc($result_set);
$paypal = $record['paypal'];

$query2 = "SELECT * FROM studio WHERE studio_id = $studio_id";
$result_set2 = mysqli_query($connection,$query2);
$record2 = mysqli_fetch_assoc($result_set2);

$query3 = "SELECT * FROM reserved_job WHERE job_id = $job";
$result_set3 = mysqli_query($connection,$query3);
$record3 = mysqli_fetch_assoc($result_set3);

$query4 = "SELECT * FROM reserved_services WHERE job_id = $job";
$result_set4 = mysqli_query($connection,$query4);
$array4 = [];
while($record4=mysqli_fetch_assoc($result_set4)){
  array_push($array4,$record4);
}

$query5 = "SELECT * FROM reserved_audio_gear WHERE job_id = $job";
$result_set5 = mysqli_query($connection,$query5);
$array5 = [];
while($record5=mysqli_fetch_assoc($result_set5)){
  array_push($array5,$record5);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/cart.css">
	<script>
  	  function target_popup(form) {
      window.open('', 'formpopup', 'width=450,height=550,resizeable,scrollbars');
      form.target = 'formpopup';
	  }
	</script>
</head>
<body>
    <?php require_once('../../inc/cust_dash_navbar.php');?>  
	<div class="row11">	
	  <div class="container">
	    <h2><?php echo $record3['date']; echo '<br>'; echo $record2['studio_name'];?></h2> 
		<div class="row1">
		  <h3>Services</h3>
		  <div class="row111">	  
	  	  <div id="col1">
	  	  <?php
			$total = 0;
			for($i=0;$i<count($array4);$i++){
		      $sern = $array4[$i]['service_name'];
			  echo "<p>$sern</p>";  
			  echo '<br>'; 
			}
		  ?>  	
		  </div>
		  <div id="col2">
		  <?php
			for($i=0;$i<count($array4);$i++){
				$serc = $array4[$i]['charge'];  
				echo "<p>$serc LKR</p>";
				echo '<br>';
				$total = $total + $serc;
			}
		  ?>	
		  </div>
		  </div>
		</div>
		<?php if(count($array5)>0){?>	
		<div class="row2">
		  <h3>Additional Equipments</h3>	
		  <div class="row222">	
		  <div id="col1">
		  <?php
			for($i=0;$i<count($array5);$i++){
			  $audn = $array5[$i]['name'];  
			  echo "<p>$audn</p>";
		      echo '<br>';     	  
			}
		  ?>
		  </div>
		  <div id="col2">
		  <?php
			for($i=0;$i<count($array5);$i++){
			  $audc = $array5[$i]['charge'];  
			  echo "<p>$audc LKR</p>";
			  echo '<br>';
			  $total = $total + $audc;     	  
			}
		  ?>
		  </div>
		  </div>
		</div>
		<?php }?>

		<div class="row3">
		  <div id="col1">
			<?php echo "<h3>Total</h3>";?>
		  </div>
		  <div id="col2">
		    <?php echo "<h3 style='width:55%; text-align:right;'>$total LKR</h3>";?> 	
		  </div>	
		</div>

		<div class="row4">
		  <div id="col1">
		    <?php echo "<h3>Advanced Payment Fee</h3>";?>
		  </div>
		  <div id="col2">
		    <?php
			  $advancedp = $total/5;
			  echo "<h3 style='width:55%; text-align:right;'>$advancedp LKR</h3>";?>
		  </div>
		</div>

		<?php
		  $advancedp_usd = $advancedp/200;
		  $query11 = "SELECT * FROM advanced_payment WHERE job_id = $job";
		  $result_set11 = mysqli_query($connection,$query11);
		  if(mysqli_num_rows($result_set11)==0){
		    $query12 = "INSERT INTO advanced_payment (job_id,total,advanced_fee) VALUES ($job,$total,$advancedp_usd)";
			$result_set12 = mysqli_query($connection,$query12);	   
		  }    
		?>

	  <div class="row grid">
	    <img src="../../img/580b57fcd9996e24bc43c530.png" style="display:inline; width:150px; height:45px;">   
	    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
		  <input type="hidden" name="business" value=<?php echo $paypal;?>>
		  <input type="hidden" name="cmd" value="_xclick">
		  <input type="hidden" name="item_name" value="Instrument pack">
	  	  <input type="hidden" name="item_number" value=<?php echo $job;?>>
		  <input type="hidden" name="amount" value=<?php echo $advancedp/200;?>>
		  <input type='hidden' name='return' value="http://localhost/Rex/view/customer/recipt.php?jobid=<?php echo $job;?>">	
		  <input type="hidden" name="currency_code" value="USD">
		  <input type="submit" name="submit" value="SUBMIT">
		</form>	

		<form action="studio_prof.php" method="post">
		  <input type="submit" value="CANCEL">
		</form>
		<p style='float:left; padding-left:10px; color:red;'><i>*Pay the advanced payment in order to Place the booking.</i></p>	
	  </div>
	  </div>	
	</div>

	<?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>