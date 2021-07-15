<?php 
require_once('../../inc/connection.php');
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>	
   <style>
         /* open the drop down list when click on the distric radio button */
               #myList {
               display: none;
               }
   </style>
	<meta charset="utf-8">
	<title>Customer Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/cust_dash.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
      <script>
               $(document).ready(function() {
               $("input:radio").click(function() {
               $('.searchSelect').hide();
               $('#' + $(this).attr("value")).show();
               });
               });
      </script>
</head>
<script>
   //view the select item in the search bar 
   function favTutorial() {
   var mylist = document.getElementById("myList");
   document.getElementById("favourite").value = mylist.options[mylist.selectedIndex].text;
   }
</script>
<body>
	<?php require_once('../../inc/cust_dash_navbar.php');?>
<div class="container">		
	<form action="../../controller/customer/cust_dash_controller.php" method="post">
  		<input type="text" name="search" id="favourite" placeholder="Search..">
		<button type="submit" name="submit-search"><i class="fa fa-search"></i></button>
			
			<label class="type">
               <input type="radio" id="all" name="type" value="all" checked="checked" class="option-input radio">All
            </label>
            <label class="type">
               <input type="radio" id="name" name="type" value="name" class="option-input radio">Name
            </label>
            <label class="type">
               <input type="radio" id="service" name="type" value="service" class="option-input radio">Service
            </label>
            <label class="type">
               <input type="radio" id="distric" name="type" value="myList" class="option-input radio">District
            </label>
			<label class="type">               
               <select id='myList' onchange="favTutorial()" class="searchSelect">
               <option> ---Choose District--- </option>
               <option> Ampara </option>
               <option> Anuradhapura</option>
               <option> Badulla </option>
               <option> Batticaloa </option>
               <option> Colombo </option>              
               <option> Galle </option>
               <option> Gampaha </option>
               <option> Hambantota </option>
               <option> Jaffna </option>
               <option> Kalutara </option>
               <option> Kandy </option>
               <option> Kegalle </option>
               <option> Kilinochchi </option>
               <option> Kurunegala </option>
               <option> Mannar </option>
               <option> Matara </option>
               <option> Matale </option>
               <option> Monaragala </option>
               <option> Mullaitivu </option>
               <option> Nuwara Eliya </option>
               <option> Polonnaruwa </option>
               <option> Puttalam </option>
               <option> Ratnapura </option>
               <option> Trincomalee </option>
               <option> Vavuniya </option>      
               </select>           
            </label>
	</form>
	
	<div class="row">
		<?php 
				$query="SELECT DISTINCT studio.studio_id,studio.profile,studio.studio_name,studio.distric,rate.rate FROM rate RIGHT JOIN studio ON rate.studio_id=studio.studio_id WHERE studio.verified=1  ORDER BY rate.rate DESC ";
				$result_set=mysqli_query($connection,$query);
				if($result_set){
					while($record = mysqli_fetch_assoc($result_set)){
						if($record['profile']){
							$profile =$record['profile'];
						}
						else{
							$profile = "studio1.png";
						}
                  $query1="SELECT * FROM rate INNER JOIN studio ON rate.studio_id=studio.studio_id WHERE rate.studio_id=$record[studio_id]";
                  $result_set1=mysqli_query($connection,$query1);
                  $rate_value=0.0;      
                  while($record1 = mysqli_fetch_assoc($result_set1)){
                     $rate_value=$rate_value+$record1['rate'];
                  } 
                  if(mysqli_num_rows($result_set1)==0){
                     $rate="-";
                  } 
                  else{
                     $rate=$rate_value/mysqli_num_rows($result_set1);
                     $rate=number_format($rate,1,'.','');
                  }                
                  

                  		echo '<div class="row2">';
								echo '<div class="col1">'; 																			
									echo "<img src='../../img/studio/$profile' height='180' width='180' >";
								echo '</div>';	
								
									echo '<div class="col2">';
									echo "<h4>$record[studio_name]<br></h4>"; 
									echo "<h5>$record[distric]</h5>";	
									echo '<div class="rating">';
                              echo  "<span><b>$rate  </b></span>";
										echo '<span class="fa fa-star checked"></span>';
                              
									echo '</div>';
									echo '</div>';
									echo '<div class="col3">';
										echo "<a href='studio_prof.php?studio_id=$record[studio_id]'>View</a>";
									echo '</div>';	
								echo '</div>';
					}	
				}					
		?>
	</div>

</div>	
<?php require_once('../../inc/minfooter.php'); ?>	
</body>
</html>