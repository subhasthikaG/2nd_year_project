<?php 
require_once('../../inc/connection.php');
session_start();

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

$studio_id = $_SESSION['studio_id'];

include("../../controller/customer/select_date_controller.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Selcet Date & Time</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/select_date.css">
	<link rel="stylesheet" type="text/css" href="../../css//calendar.css">
	<style>
      .container{
      font-family: sans-serif;
      width: 100%;
      padding-right:15px;
      padding-left:15px;
      }
    </style>
</head>

<body>
<?php require_once('../../inc/cust_dash_navbar.php');?>

<div class="row1">
  <div class="col1">
    <h1>SELECT A DATE >></h1>  
  </div>

  <div class="col2">
  <div class="container"> 
    <?php 
      $dateComponents = getdate(); 
      if(isset($_GET['month']) && isset($_GET['year'])){
        $month = $_GET['month']; 			     
        $year = $_GET['year'];
      }
      else{
        $month = $dateComponents['mon']; 			     
        $year = $dateComponents['year'];
      }
      //call the function in controller
      build_calendar($month,$year,$record11,$blocked_list,$booked_list,$temp_blocked_list,$connection);
    ?> 
  </div>
  </div> 
</div>
	
<?php require_once('../../inc/minfooter.php');?>
</body>
</html>