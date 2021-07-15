<?php 
require_once('../../inc/connection.php');
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Details</title>
	<link rel="stylesheet" type="text/css" href="../../css/studio/edit_studio_details.css">
	<script src="../../assets/pass_change_length.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRPjxeL78zpFysY_Im4Me74oUEdH9-PFc&callback=initMap&libraries=&v=weekly" defer></script>
</head>
<body>
	<div class="nav"><?php require_once('../../inc/stu_dash_navbar.php');?></div>

	<?php 	
	  $query="SELECT * FROM studio WHERE studio_id = $user_id"; //query to get data of the logged studio ($user id is included from studio_dash_navbar.php)
	  $result_set=mysqli_query($connection,$query);
	  if($result_set){
		$record = mysqli_fetch_assoc($result_set);
			if($record['cover']){
				$url1 = "../../img/studio/$record[cover]";
				
			}
			else{
				$url1 = "../../img/studio/studio_cover.jpg";
			}
			if($record['profile']){
				$url2 = "../../img/studio/$record[profile]";
				
			}
			else{
				$url2 = "../../img/studio/studio_profile.jpg";
			}		
		}
		
	  $query2 = "SELECT * FROM owner INNER JOIN studio ON studio.owner_id = owner.owner_id WHERE studio.studio_id = $user_id";
	  $result_set2 = mysqli_query($connection,$query2);
	  if($result_set2){
		$record2= mysqli_fetch_assoc($result_set2);
	  }
	  $query3 = "SELECT * FROM studio_portfolio WHERE studio_id = '$user_id'";
	  $result_set3 = mysqli_query($connection,$query3);
	  if($result_set3){
		$record3= mysqli_fetch_assoc($result_set3);  
	  }	
	?>
	
	<div class="row">	 
			
		 	<div class="upper-container" style="background-image:url(<?php echo $url1?>);">                 
            	<div class="image-container">					   
					   <img src=<?php echo $url2 ?> width="230px" height="230px" />		 
					   
				</div>	
				<div class="profile_upload">
								<form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>"  method="post" enctype="multipart/form-data"  > 
									<label for="profile"><img src="../../img/studio/584abf432912007028bd9337.png" alt=""></label>
									<input type="file" id="profile" class="my_file" hidden="true" name="profile">
									<button type="submit_profile" class="profile-button" name="submit_profile" >Upload</button>
								</form>	
				</div>			
				<div class="cover_upload">
								<form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" method="post" enctype="multipart/form-data"  > 
									<label for="cover"><img src="../../img/studio/584abf432912007028bd9337.png" alt=""></label>
									<input type="file" id="cover" class="my_file" hidden="true" name="cover">
									<button type="submit_cover" class="cover-button" name="submit_cover" >Upload</button>
								</form>	
				</div>


			</div>	
		
				 
	  

		<div class="error">
	      <?php
			if(isset($_GET['errors']) && !empty($_GET['errors'])){
			  $str_arr = unserialize(urldecode($_GET['errors']));
    		  foreach($str_arr as $error){
				echo $error . '<br>';
				}
			}
		  ?>
		</div>

		<button class="open-button2" onclick="document.getElementById('description').style.display='block'">Add Description</button>
		<div class="modal" id="description">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post"> 
		  <div class="textarea">         
            <textarea id="description" placeholder="Type Here..." name="description" rows="8" cols="44"><?php echo $record['description']; ?></textarea>
		  </div>
            <button type="submit_des" class="btn" name="submit_des">Save</button>
			<button type="button" class="btn cancel" onclick="document.getElementById('description').style.display='none'">Close</button>	
		  </form>	
		</div>
		<script>
		   var modal = document.getElementById('description');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   } 	
		</script>

		<button class="open-button2" onclick="document.getElementById('portfolio').style.display='block'">Add Portfolios</button>
		<div class="modal" id="portfolio">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">
		    <p style="text-align:center; padding-bottom:5px;">Please Enter the Youtube <b>Video ID</b> only.<br><span style="font-style:italic; color:red;">Example: www.youtube.com/watch?v=vidID</span></p>
			<label for="port1"><b>Link 1</b></label>
			<input type="text" value="<?php echo $record3['port1']; ?>"  name="port1">
			<label for="port2"><b>Link 2</b></label>
			<input type="text" value="<?php echo $record3['port2']; ?>"  name="port2">
			<label for="port3"><b>Link 3</b></label>
			<input type="text" value="<?php echo $record3['port3']; ?>"  name="port3">
			<label for="port4"><b>Link 4</b></label>
			<input type="text" value="<?php echo $record3['port4']; ?>"  name="port4">
			
			<button type="submit_port" class="btn" name="submit_port">Save</button>
			<button type="button" class="btn cancel" onclick="document.getElementById('portfolio').style.display='none'">Close</button>	  
		  </form>   	
		</div>
		<script>
		   var modal = document.getElementById('portfolio');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   } 	
		</script>
	
		<div class="column col1">
		<h1>STUDIO DETAILS</h1>
		
		<button class="open-button" onclick="document.getElementById('nameForm').style.display='block'">Edit</button>
		<h2>Name : <?php echo $record['studio_name']; ?></h2>

		<div class="modal" id="nameForm">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">  

		    <label for="name"><b>Studio Name</b></label>
		    <input type="text" value="<?php echo $record['studio_name']; ?>"  name="name">

		    <button type="submit_name" class="btn" name="submit_name">Save</button>
		    <button type="button" class="btn cancel" onclick="document.getElementById('nameForm').style.display='none'">Close</button>
		  </form>
		</div>	
		<script>
		   var modal = document.getElementById('nameForm');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   } 	
		</script>

		
		<button class="open-button" onclick="document.getElementById('noForm').style.display='block'">Edit</button>
		<h2>Contact No : <?php echo $record['s_tele_no'] ?></h2>
		<div class="modal" id="noForm">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">
		    
		    <label for="text"><b>Contact No</b></label>
		    <input type="tel" value="<?php echo $record['s_tele_no'];?>" name="tele_no" pattern="[0-9]{10}">

		    <button type="submit_phone" class="btn" name="submit_phone">Save</button>
		    <button type="button" class="btn cancel" onclick="document.getElementById('noForm').style.display='none'">Close</button>
		  </form>
		</div>
		<script>
		   var modal = document.getElementById('noForm');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   }
		</script>	


		<button class="open-button" onclick="document.getElementById('addForm').style.display='block'">Edit</button>
		<h2>Address : <?php echo $record['s_address_line1']. ', '. $record['s_address_line2']. ', '. $record['s_city']. ', '. $record['distric']. '.'; ?></h2>
		<div class="modal" id="addForm">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">
		    
		    <label for="text"><b>Address Line 1</b></label>
		    <input type="text" value="<?php echo $record['s_address_line1']; ?>" name="add_1" >
		    <label for="text"><b>Address Line 2</b></label>
		    <input type="text" value="<?php echo $record['s_address_line2']; ?>" name="add_2" >
			<label for="text"><b>City</b></label>
		    <input type="text" value="<?php echo $record['s_city']; ?>" name="City" >
		    <label for="disdop"><b>District</b></label>
			<!-- <input type="text" value="<?php echo $record['distric']; ?>" name="dist" > -->
			<select id = "disdop" name="distric">
               <option value = "Ampara" <?php if($record['distric']=='Ampara'){echo 'selected';}?>>Ampara</option>
               <option value = "Anuradhapura" <?php if($record['distric']=='Anuradhapura'){echo 'selected';}?>>Anuradhapura</option>
               <option value = "Badulla" <?php if($record['distric']=='Badulla'){echo 'selected';}?>>Badulla</option>
               <option value = "Batticaloa" <?php if($record['distric']=='Batticola'){echo 'selected';}?>>Batticaloa</option>
               <option value = "Colombo" <?php if($record['distric']=='Colombo'){echo 'selected';}?>>Colombo</option>
               <option value = "Galle" <?php if($record['distric']=='Galle'){echo 'selected';}?>>Galle</option>
               <option value = "Gampaha" <?php if($record['distric']=='Gampaha'){echo 'selected';}?>>Gampaha</option>
               <option value = "Hambantota" <?php if($record['distric']=='Hambantota'){echo 'selected';}?>>Hambantota</option>
			   <option value = "Jaffna" <?php if($record['distric']=='Jaffna'){echo 'selected';}?>>Jaffna</option>
               <option value = "Kalutara" <?php if($record['distric']=='Kalutara'){echo 'selected';}?>>Kalutara</option>
               <option value = "Kandy" <?php if($record['distric']=='Kandy'){echo 'selected';}?>>Kandy</option>
               <option value = "Kegalle" <?php if($record['distric']=='Kegalle'){echo 'selected';}?>>Kegalle</option>
               <option value = "Kilinochchi" <?php if($record['distric']=='Kilinochchi'){echo 'selected';}?>>Kilinochchi</option>
               <option value = "Kurunegala" <?php if($record['distric']=='Kurunegala'){echo 'selected';}?>>Kurunegala</option>
               <option value = "Mannar" <?php if($record['distric']=='Mannar'){echo 'selected';}?>>Mannar</option>
               <option value = "Matale" <?php if($record['distric']=='Matale'){echo 'selected';}?>>Matale</option>
               <option value = "Matara" <?php if($record['distric']=='Matara'){echo 'selected';}?>>Matara</option>
               <option value = "Monaragala" <?php if($record['distric']=='Monaragala'){echo 'selected';}?>>Monaragala</option>
               <option value = "Mullaitivu" <?php if($record['distric']=='Mullaitivu'){echo 'selected';}?>>Mullaitivu</option>
               <option value = "Nuwara Eliya" <?php if($record['distric']=='Nuwara Eliya'){echo 'selected';}?>>Nuwara Eliya</option>
               <option value = "Polonnaruwa" <?php if($record['distric']=='Polonnaruwa'){echo 'selected';}?>>Polonnaruwa</option>
               <option value = "Puttalam" <?php if($record['distric']=='Puttalam'){echo 'selected';}?>>Puttalam</option>
               <option value = "Ratnapura" <?php if($record['distric']=='Ratnapura'){echo 'selected';}?>>Ratnapura</option>
               <option value = "Trincomalee" <?php if($record['distric']=='Trincomalee'){echo 'selected';}?>>Trincomalee</option>
               <option value = "Vavuniya" <?php if($record['distric']=='Vavuniya'){echo 'selected';}?>>Vavuniya</option>
            </select>
		    <label for="text"><b>Postal Code</b></label>
		    <input type="text" value="<?php echo $record['postalcode']; ?>" name="post_code" >
		    <button type="submit_address" class="btn" name="submit_address">Save</button>
		    <button type="button" class="btn cancel" onclick="document.getElementById('addForm').style.display='none'">Close</button>
		  </form>
		</div>
		<script>
		   var modal = document.getElementById('addForm');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   }
		</script>

		<button class="open-button2" onclick="document.getElementById('PWForm').style.display='block'">Change Password</button>

		<div class="modal" id="PWForm">
		  <form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">
		    <input type="Password" placeholder="old Password"  name="old_password">
		    <input type="Password" placeholder="New Password" name="password" id="pass1" onkeyup="checkPass(); return false">		   
		    <input type="Password" placeholder="Re-Enter New Password"  name="new_password" id="pass2" onkeyup="checkPass(); return false">

		    <button type="submit_password" class="btn" name="submit_ow_password">Save</button>
		    <button type="button" class="btn cancel" onclick="document.getElementById('PWForm').style.display='none'">Close</button>
		  </form>
		</div>	
		<script>
		   var modal = document.getElementById('PWForm');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   }
		</script>
		</div>  

		<div class="column col2">
		<script>
		  function initMap() {
  			const stu = {lat: <?php echo $record['latitude'];?>, lng: <?php echo $record['longitude'];?>};
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

		<button class="open-button2" title="1.open Google Maps.
2.Right-click the place or area on the map.
3.Select What's here? At the bottom.
4.you’ll see a card with the coordinates." onclick="document.getElementById('LocForm').style.display='block'">Change Location</button>

		<div class="modal" id="LocForm">
		<form action="<?php echo "../../controller/studio/studio_profile_edit_controller.php?s_id=$user_id"?>" class="form-container animate" method="post">
			<label for="text"><b>Latitude</b></label>
			<input type="text" value="<?php echo $record['latitude']; ?>" name="latitude">
			<label for="text"><b>Longitude</b></label>
			<input type="text" value="<?php echo $record['longitude']; ?>" name="longitude">

			<button type="submit_location" class="btn" name="submit_location">Save</button>
			<button type="button" class="btn cancel" onclick="document.getElementById('LocForm').style.display='none'">Close</button>
		</form>	
		</div>
		<script>
		   var modal = document.getElementById('LocForm');
		   window.onclick = function(event) {
    		 if (event.target == modal) {
        	 modal.style.display = "none";
    	     }
		   }
		</script>
		</div>	
	</div>

	<?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>