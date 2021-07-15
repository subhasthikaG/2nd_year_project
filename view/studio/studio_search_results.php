<?php 
require_once('../../inc/connection.php');
session_start();
	if(isset($_SESSION['type'])){
		$type=$_SESSION['type']; //store radio type to set the radio button checked
	}

?>
<!DOCTYPE html>
<html>
<head>
	<style>
         /* open the drop down list when click on the distric radio button */
               #myList {
               display: none;
               }
   </style>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title>Studio Dashboard</title>			
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
	<div class="nav"><?php require_once('../../inc/stu_dash_navbar.php');?></div>
	<div class="0">
	<form action="../../controller/studio/studio_dash_controller.php" method="post">
  		<input type="text" id="favourite" name="search" placeholder="Search..">
		<button type="submit" name="submit-search"><i class="fa fa-search"></i></button>
			<label class="type">
               <input type="radio" id="all" name="type" value="all" class="option-input radio" <?php if($type=='all') echo "checked"  ?>>All
            </label>
            <label class="type">
               <input type="radio" id="name" name="type" value="name" class="option-input radio" <?php if($type=='name') echo "checked"  ?>>Name
            </label>
            <label class="type">
               <input type="radio" id="service" name="type" value="service" class="option-input radio"<?php if($type=='service') echo "checked"  ?>>Service
            </label>
            <label class="type">
               <input type="radio" id="distric" name="type"  class="option-input radio" <?php if($type=='distric') echo "checked"  ?> value="myList" >District
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
	</div>
	<div class="">
        <?php 
            echo '<div class="row">';
			if(isset($_GET['search_result']) && !empty($_GET['search_result'])){
				$studio_id_arr = unserialize(urldecode($_GET['search_result']));//get the studio id array              
				foreach($studio_id_arr as $s){ //for loop to get studio names
					$query="SELECT * FROM studio WHERE studio_id =$s[0] AND verified=1 AND email_verified=1"; //select studio name 
					$result_set=mysqli_query($connection,$query);
					if($result_set){
						while($record =mysqli_fetch_assoc($result_set)){
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
									echo "<a href='other_studio_prof.php?studio_id=$record[studio_id]'>View</a>";
								echo '</div>';	
							echo '</div>';
					}
                        
                    }
					
				}
			}
                else if(isset($_GET['error'])){
				 echo '<div class="error">';
					echo $_GET['error'];
				 echo '</div>';
                }
            echo '</div>';
        ?>
	</div>

  	

	

</body>
</html>