<?php require_once('../../inc/connection.php');
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
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Studio Dashboard</title>
      <link rel="stylesheet" href="../../css/studio/studio_dash.css">
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
<?php require_once('../../inc/stu_dash_navbar.php');?>
    <div class="container">      
      <div class="search"> 
         <form action="../../controller/studio/studio_dash_controller.php" method="post">  

            <input type="text" id="favourite" name="search" placeholder="Search..">
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
               <input type="radio" id="distric" name="type" class="option-input radio" value="myList">District
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
      <div class="buttons">
      <div class="service">
         <button onclick="window.location.href='add_services.php';">Add Services</button>
      </div>      
      <div class="audio-gears">
         <button onclick="window.location.href='add_audio_gears.php';">Add Additional Equipments</button>              
      </div>
      <div class="schedule">
         <button onclick="window.location.href='studio_schedule.php';">Edit My Schedule</button>              
      </div>

      </div>   
  </div>
  <?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>