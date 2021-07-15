<?php 
require_once('../../inc/connection.php');
session_start();

if(isset($_GET['jobid'])){
  $jobid = $_GET['jobid'];
  $query1 = "UPDATE advanced_payment SET ispaid = 1";
  $result_set1 = mysqli_query($connection,$query1);
  $query2 = "UPDATE reserved_job SET isplaced = 1,temp_blocked = 0 WHERE job_id = '$jobid'";
  $result_set2 = mysqli_query($connection,$query2);
  $query3 = "SELECT s_email FROM studio INNER JOIN reserved_job ON studio.studio_id = reserved_job.studio_id WHERE reserved_job.job_id = '$jobid'";
  $result_set3 = mysqli_query($connection,$query3);
  $row3 = mysqli_fetch_assoc($result_set3);
  $jobmail = $row3['s_email'];
  
  $to=$jobmail;
  $from='recordexonlineres@gmail.com';
  $subject='New Booking'; 
  $message='You have a New Booking Under Booking ID: ';
  $message.=$jobid;
  $message.='Visit RecordEx for more Information.';
  $header="From: {$from}\r\nContent-Type: text/html;";

  $send_result=mail($to,$subject,$message,$header);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Successful</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/recipt.css">
</head>
<body>
  <?php require_once('../../inc/cust_dash_navbar.php');?>

  <div class="container">
	<h1>Booking Successful !</h1>
  <form action="pdf.php" method="post" target="_blank">
  <input type="text" name="jobid" value="<?php echo $jobid;?>" hidden>
  <input type="submit" name="receipt" value="E-Receipt">
  </form>
  </div>

  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>