<?php
require_once('../../inc/connection.php');
session_start();

if(isset($_GET['studio_id'])){
	//echo $_GET['studio_id'];
	$query="SELECT * FROM studio WHERE studio_id=$_GET[studio_id]";
	$result_set=mysqli_query($connection,$query);
	if($result_set){
		$studio_record=mysqli_fetch_assoc($result_set);
		$studio_id=$studio_record['studio_id'];
		$_SESSION['studio_id']=$studio_id;
		// $_SESSION['user_id'];
		//get cover photo and profile photo if they are exist 
		if($studio_record['cover']){
			$cover_url="../../img/studio/$studio_record[cover]"; //get the cover path 	
		}
		else{
			$cover_url="../../img/studio/studio_cover.jpg"; //get the default photo	
		}
		if($studio_record['profile']){
			$profile_url="../../img/studio/$studio_record[profile]"; //get the profile path
		}
		else{
			$profile_url="../../img/studio/studio_profile.jpg"; //get the profile path
		}
		
		$studio_name=$studio_record['studio_name'];//ge studio name
		$description = $studio_record['description'];

		$query2 = "SELECT * FROM studio_portfolio WHERE studio_id = '$studio_id'";
		$result_set2 = mysqli_query($connection,$query2);
		$port_record = mysqli_fetch_assoc($result_set2);

		$query3="SELECT * FROM studio_service WHERE studio_id=$studio_id";
		$result_set3=mysqli_query($connection,$query3);

		$query4="SELECT name,charge FROM studio_audio_gear WHERE studio_id=$studio_id GROUP BY name";
		$result_set4=mysqli_query($connection,$query4);
	} 
}



?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $studio_name; ?></title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/studio_prof.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRPjxeL78zpFysY_Im4Me74oUEdH9-PFc&callback=initMap&libraries=&v=weekly" defer></script>
</head>
<body>
	<div class="nav"><?php require_once('../../inc/stu_dash_navbar.php');?></div>
	<div class="row">

	<div class="secondary">
	  <div class="btnbox">
		<a href="#portfolio" id="portbtn">Watch Portfolios >></a>
		<a href="#details">Location >></a>
		<a href="#services" id="servicebtn">Available Services >></a>	
	  </div>
	</div>

	<div class="primary">
	<div class="container">
		<div class="cover" style="background-image: url(<?php echo $cover_url?>);">
		  
		  
		  <div class="pic" style="background-image: url(<?php echo $profile_url?>);"></div>
		  <p><?php echo $studio_name ?></p>
		</div>
	</div>
	<div class="container" id="description">
	  <p><?php echo $description;?></p>
	</div>

	<div class="container details" id="details">
		  <h2>Details</h2>
		  <div class="detailist">	  	
          <div class="place">
            <span class="fas fa-map-marker-alt"></span>
            <span class="text"><?php echo $studio_record['s_address_line1'].', '.$studio_record['s_address_line2'].', '.$studio_record['s_city'].'.';?></span>
		  </div>
		  <div class="phone">
            <span class="fas fa-phone-alt"></span>
            <span class="text"><?php echo $studio_record['s_tele_no']; ?></span>
		  </div>
		  <div class="email">
            <span class="fas fa-envelope"></span>
            <span class="text"><?php echo $studio_record['s_email']; ?></span>
		  </div>
		  </div>
	
		  <script>
		  function initMap() {
  			const stu = {lat: <?php echo $studio_record['latitude'];?>, lng: <?php echo $studio_record['longitude'];?>};
  			const map = new google.maps.Map(document.getElementById("map"), {
    		  zoom: 20,
    		  center: stu,
  			});
  			const marker = new google.maps.Marker({
      		  position: stu,
      		  map: map,
  			});	  
		  }
		  </script>
		  <div id="map"></div> 
	</div>

	<div id="services" class="container" style="top: 10%; padding-bottom: 5%">
		<h2>AVAILABLE SERVICES</h2>
		<div class="service clearfix">
		<?php
		  if(mysqli_num_rows($result_set3)>0){ 
		 	echo "<table>
			<tr>
			<th>SERVICE</th>
			<th>FEE/H (LKR)</th>
			</tr>";
			
			while($row3 = mysqli_fetch_assoc($result_set3)){
			  echo "<tr>";
  			  echo "<td>" . $row3['service_name'] . "</td>";
  			  echo "<td>" . $row3['service_charge'] . "</td>";
			  echo "</tr>";		
			}
			echo "</table>";
		  }
		  else{
		    echo "<p style='color:red;'><b><i>NO SERVICES AVAILABLE!</i></b></p>"; 		  
		  }	 
		  ?>
		</div>
	</div>

	<div id="services" class="container" style="top: 10%; padding-bottom: 5%">
		<h2>AVAILABLE AUDIO GEARS</h2>
		<div class="service clearfix">
		<?php
		  if(mysqli_num_rows($result_set4)>0){ 
		 	echo "<table>
			<tr>
			<th>AUDIO GEAR</th>
			<th>FEE/H (LKR)</th>
			</tr>";
			
			while($row4 = mysqli_fetch_assoc($result_set4)){
			  echo "<tr>";
  			  echo "<td>" . $row4['name'] . "</td>";
			  echo "<td>" . $row4['charge'] . "</td>";
			  echo "</tr>";		
			}
			echo "</table>";
		  }
		  else{
		    echo "<p style='color:red;'><b><i>NO AUDIO GEARS AVAILABLE!</i></b></p>";  	  
		  }	 
		  ?>
		</div>
	</div>

	<div class="container portfolio" id="portfolio">
		<h2>PORTFOLIO</h2>
		
		<?php
		if(mysqli_num_rows($result_set2)>0 && ($port_record['port1']!=NULL || $port_record['port2']!=NULL || $port_record['port3'] || $port_record['port4'])){
		  echo
		   "<div class='video'>
			<iframe width='320' height='240' poster='../../img/studio-mic.jpg' controls src='https://www.youtube.com/embed/$port_record[port1]' type='video/mp4'>
			</iframe>
			</div> 
		  
		    <div class='video'>
		    <iframe width='320' height='240' poster='../../img/studio-mic.jpg' controls src='https://www.youtube.com/embed/$port_record[port2]' type='video/mp4'>
		    </iframe>
		    </div>  
		  
		    <div class='video'>
		    <iframe width='320' height='240' poster='../../img/studio-mic.jpg' controls src='https://www.youtube.com/embed/$port_record[port3]' type='video/mp4'>
		    </iframe>
		    </div>
  
		    <div class='video'>
		    <iframe width='320' height='240' poster='../../img/studio-mic.jpg' controls src='https://www.youtube.com/embed/$port_record[port4]' type='video/mp4'>
		    </iframe>
		    </div>";	
		}
		else{
			echo "<p style='color:red; padding-top:15px;'><b><i>NO PORTFOLIOS AVAILABLE!</i></b></p>"; 
		}
		?>
	</div>
	</div>
	</div>
	<?php require_once('../../inc/minfooter.php');?>
</body>
</html>