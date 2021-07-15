<?php

  require_once('../../inc/connection.php');
  session_start();

  $userid = $_SESSION['user_id'];

  include('../../controller/studio/studio_schedule_controller.php');

  if(isset($_GET['error'])){
    $error = $_GET['error'];
    echo "<script>alert($error);</script>";
  }
  if(isset($_GET['answer'])){
    $answer = $_GET['answer'];
    echo "<script>alert($answer);</script>";
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Studio Shedule</title>
	<link rel="stylesheet" type="text/css" href="../../css/studio/studio_schedule.css">
	<link rel="stylesheet" href="../../css/calendar.css"> 
	<style>
	  .container{
		font-family: sans-serif;
		width: 80%;
		padding-right:15px;
		padding-left:15px;
      }
	</style>
</head>
<body>
	<div class="nav body" style="padding-left: 0;">
		<?php require_once('../../inc/stu_dash_navbar.php');?>
	</div>

	<div class="row1">
	  <div class="col1">
      <?php
        if($record11['issatblocked']==0){
          echo "<a href='studio_schedule.php?blocksat=$userid'>Block Saturdays</a>";
        }
        else{
          echo "<a href='studio_schedule.php?unblocksat=$userid'>Unblock Saturdays</a>";
        }
        if($record11['issunblocked']==0){
          echo "<a href='studio_schedule.php?blocksun=$userid'>Block Sundays</a>";
        }
        else{
          echo "<a href='studio_schedule.php?unblocksun=$userid'>Unblock Sundays</a>";
        }
        ?>  
          <button class="open-button" onclick="document.getElementById('dateForm').style.display='block'">Block a day</button>
          <button class="open-button open-button-2" onclick="document.getElementById('dateForm2').style.display='block'">Unblock a day</button>
          <button class="open-button open-button-3" onclick="document.getElementById('dateForm3').style.display='block'">VIEW BLOCKED LIST</button> 
	  </div>

	  <div class="col2">
	  	<div class="container"> 
    	<div class="row"> 
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
        build_calendar($month,$year,$record11,$blocked_list,$booked_list,$temp_blocked_list,$connection); 
      ?> 
    </div> 
    </div> 
	  </div>
    <?php $todate = date("Y-m-d");?>    
    <div class="modal" id="dateForm">
		  <form action="?" class="form-container animate" method="post">
		    
		    <label for="date" ><b>BLOCKING DATE</b></label><br>
		    <input type="date" name="date" min="<?php echo $todate;?>">

		    <button type="submit" class="btn submit" name="submit">BLOCK</button>
        <button type="button" class="btn submit" onclick="document.getElementById('dateForm').style.display='none'">Cancel</button>
		  </form>
		</div>
    <div class="modal" id="dateForm2">
		  <form action="?" class="form-container animate" method="post">
		    
		    <label for="date2" ><b>UNBLOCKING DATE</b></label><br>
		    <input type="date" name="date2" min="<?php echo $todate;?>">

		    <button type="submit" class="btn submit" name="submit2">UNBLOCK</button>
        <button type="button" class="btn submit" onclick="document.getElementById('dateForm2').style.display='none'">Cancel</button>
		  </form>
		</div>
    <div class="modal" id="dateForm3">
      <div class="modal-content">
        <h3>BLOCKED DATES</h3>
        <?php
          if($record11['issatblocked']==1){
            echo '<h5>* ALL SATURDAYS</h5>';
          }
          if($record11['issunblocked']==1){
            echo '<h5>* ALL SUNDAYS</h5>';
          }
          if(count($blocked_list)>0){
            for($n=0; $n<count($blocked_list); $n++){?>
              <h5>* <?php echo $blocked_list[$n]['dates'];?></h5><?php
            }
          }
          else{
            echo 'NO BLOCKED DATES';
          }
        ?>
      </div>
    </div>  
	</div>

	<?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>

<script>
  var modal = document.getElementById('dateForm3');
window.onclick = function(event){
if(event.target == modal){
modal.style.display = "none";
}
}
</script> 