<?php 
require_once('../../inc/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../../css/studio/add_services.css">
</head>

<body> 
 <div class="nav"><?php require_once('../../inc/stu_dash_navbar.php');?></div>                
<main>           
<div class="column" style="width: 70%;">
  <div class="adds">        
                <center><h1 class="addtitle">UPDATE EXISTING SERVICES</h1></center>       
        <?php 
                $query1="SELECT * FROM studio_service WHERE studio_id=$user_id";
                $result_set1 = mysqli_query($connection,$query1);
                if($result_set1){
                        $rows=mysqli_num_rows($result_set1);
                        if($rows>=1){
                                $temp=1;                                        
                                echo '<form action="../../controller/studio/add_services_controller.php?studio_id='.$user_id.'&rows='.$rows.'" class="service_form" method="post">';
                                while($record = mysqli_fetch_assoc($result_set1)){
                                        if($record['status']==1){
                                                $status="checked";
                                        }
                                        else{
                                                $status="unchecked";
                                        }
                                        echo '<div class="row serset" >                               
                                                <div class="column">
                                                                <lable class="description" name="service'.$temp.'"><h2>'.$record['service_name'].'</h2></lable> 
                                                </div>
                                                <div class="column">
                                                        <div class="slideTwo">                                                               
                                                                <input type="hidden"  id="unchecked_service'.$temp.'"  name="uncheck'.$temp.'"  value="'.$record['service_name'].'"/>                                                                        
                                                                <input type="checkbox"  id="service'.$temp.'"   name="check'.$temp.'"  value="'.$record['service_name'].'"  '.$status.'/>
                                                                <label for="service'.$temp.'"></label>                  
                                                        </div>
                                                
                                                </div>  
                                                <div class="column" >
                                                        <div class="form-popup" id="dvservice'.$temp.'">  
                                                                <div class="form__group">
                                                                <input type="text" class="form__input" name="charge'.$temp.'" value="'.$record['service_charge'].'"/>
                                                                </div>                               
                                                                        
                                                        </div>	
                                                        <script>
                                                        function openForm'.$temp.'(service'.$temp.') {
                                                                var dvservice'.$temp.' = document.getElementById("dvservice'.$temp.'");
                                                                dvservice'.$temp.'.style.display = service'.$temp.'.checked ? "block" : "none";
                                                        
                                                        } 
                                                        </script>
                                                </div>  
                                        </div> 
                                        ';
                                        $temp++;
                                }
                                echo '
                                <div class="row">
   
                                        <div class="column" style="padding: 15px 538px;">
                                                <button type="submit_name" class="btn" name="submit_service2">Save</button>
                                        </div>
                
                                </div>
                                </form>
                                ';

                        }
                        else{
                                $query2 = "SELECT * FROM sample_service";
                                $result_set2=mysqli_query($connection,$query2);
                                if($result_set2){
                                        $rows=mysqli_num_rows($result_set2);
                                        echo '<form action="../../controller/studio/add_services_controller.php?studio_id='.$user_id.'&rows='.$rows.'" class="service_form" method="post">';
                                        while($record = mysqli_fetch_assoc($result_set2)){
                                                echo '<div class="row serset" >                               
                                                        <div class="column">
                                                                <lable class="description" name="service'.$record['service_id'].'"><h2>'.$record['name'].'</h2></lable> 
                                                        </div>
                                                        <div class="column">
                                                                <div class="slideTwo">	
                                                                        <input type="checkbox" id="service'.$record['service_id'].'"  onclick="rdonly'.$record['service_id'].'(this)"  name="check'.$record['service_id'].'"  value="'.$record['name'].'" />
                                                                        <label for="service'.$record['service_id'].'"></label>          
                                                                </div>
                                                        </div>  
                                                        <div class="column">

                                                        <input type="text" class="form__input" id="pay'.$record['service_id'].'" name="charge'.$record['service_id'].'" placeholder="Charge per hour" readonly>
                                                                <script>
                                                                function rdonly'.$record['service_id'].'(service'.$record['service_id'].') {
                                                                  document.getElementById("pay'.$record['service_id'].'").removeAttribute("readonly");
                                                                }
                                                                </script>
                                                        </div>  
                                                </div> 
                                                ';
                                        }
                                        echo '
                                        <div class="row">
                                                <div class="column" style="padding: 10px 538px;">
                                                        <button type="submit_name" class="btn" name="submit_service1">Save</button>
                                                </div>
                        
                                        </div>
                                        </form>
                                        ';

                                }
                                else{
                                        echo "erorr";
                                }

                        }
                }

                
        ?>               
                                                   
         <?php  
                if(isset($_GET['added'])){  
                         $massage=$_GET['added']; 
                         function function_alert1($message) { 
                                // Display the alert box  
                                echo "<script>alert('$message');</script>"; 
                        }
                        function_alert1($massage);                                                                         
                                                                               
                 }                             
                else if(isset($_GET['deleted'])){
                        $massage=$_GET['deleted'];
                        function function_alert2($message) {                                  
                                echo "<script>alert('$message');</script>"; 
                        }
                        function_alert2($massage);                                
                }
                if(isset($_GET['updated'])){
                        $massage=$_GET['updated'];
                        function function_alert3($message) {                                  
                                echo "<script>alert('$message');</script>"; 
                        }
                        function_alert3($massage); 
                         
                }
                if(isset($_GET['new_service'])){
                        $massage=$_GET['new_service'];
                        function function_alert4($message) {                                  
                                echo "<script>alert('$message');</script>"; 
                        }
                        function_alert4($massage); 
                         
                }
                if(isset($_GET['error'])){
                        $massage=$_GET['error'];
                        function function_alert4($message) {                                  
                                echo "<script>alert('$message');</script>"; 
                        }
                        function_alert4($massage); 
                         
                }     
        ?>     
  </div>
</div>  

<div class="column" style="width: 30%;">
  <div class="mys">
    <div class="form-popup" id="nameForm">
      <center><h1 class="addtitle">ADD NEW SERVICE</h1></center>
        <form action='<?php echo "../../controller/studio/add_services_controller.php?studio_id=$user_id"?>' class="form-container" method="post">  

	  <label for="service" class="service">Service Name</label>
	  <input type="text" value="" name="service_name" placeholder="Enter Your Service Name" required>

          <label for="charge" class="service">Service charge</label>
          <input type="text" value=""  name="charge" placeholder="Per Hour" required>

          <button type="submit_name" class="btn save" name="submit_other_service">Save</button>
	</form>
    </div>         
  </div>
</div>            
</main>
<?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>