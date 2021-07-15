<?php
require_once('../inc/connection.php');
session_start();
?>
<?php 

                    if( isset($_GET['cus_complaint_id'])){//check whether admin press the solve btton on customer complaints    
                        $complaint_id=$_GET['cus_complaint_id'];                      
                        $query="UPDATE complaint SET flag=2 WHERE complaint_id=$complaint_id";//update the flag 0 to 1(then this row will not be view by admin)
                        $result_set=mysqli_query($connection,$query);
                    }
                    if( isset($_GET['stud_complaint_id'])){//check whether admin press the solve btton on studio complaints
                        $complaint_id=$_GET['stud_complaint_id'];
                        $query="UPDATE complaint SET flag=2 WHERE complaint_id=$complaint_id"; //update the flag 0 to 1 (then this row will not be view by admin)
                        $result_set=mysqli_query($connection,$query);
                    
                    }
 
                   
                    $errors1= array();
                    $errors2= array();
                    //join customer_complaint with studio and customer
                    $query1="SELECT * FROM complaint JOIN studio ON  studio.studio_id = complaint.studio_id JOIN customer ON customer.c_id=complaint.c_id WHERE complaint.flag=1 "; 
                    $result_set1=mysqli_query($connection,$query1);
                            if($result_set1){
                                if(mysqli_num_rows($result_set1)==0){ //check whether the number of complants from customers is 0
                                     $errors1[]="There is no complaints from customers";
                                }
                                else{
                                    //store data in the customer table which takes from database
                                    $table1 = "<table style='min-width:80%; max-width:80%;'>";                                    
                                    $table1 .= "<tr><th>customer(from)</th><th>Studio(to)</th><th>customer-email</th><th>studio-email</th><th>description</th><th>slove</th>";
                                    while($record =mysqli_fetch_assoc($result_set1)){
                                       $complaint_id=$record['complaint_id'];
                                       $table1 .= "<tr>";
                                       $table1.= "<td>".$record['first_name']."</td>";
                                       $table1.= "<td>".$record['studio_name']."</td>";
                                       $table1.= "<td>".$record['email']."</td>";
                                       $table1.= "<td>".$record['s_email']."</td>";
                                       $table1.= "<td>".$record['com_description']."</td>";
                                       $table1 .= "<td>"."<form action='complaint.php?cus_complaint_id=$complaint_id' method='post' ><button type='submit' name='solve'>SOLVED</button></form>"."</td>";
                                       $table1.= "</tr>";
                                    }
                                    $table1.= "</table>";
                                   
                                }
                                                   
                            }
                            else{
                                
                            }
                    
                  
                    $query2="SELECT * FROM complaint JOIN studio ON  studio.studio_id = complaint.studio_id JOIN customer ON customer.c_id=complaint.c_id  WHERE complaint.flag=0 "; 
                    $result_set2=mysqli_query($connection,$query2);
                            if($result_set2){
                                if(mysqli_num_rows($result_set2)==0){//check whether the number of complants from studios is 0
                                    $errors2[]="There is no complaints from studios";
                                }
                                else{
                                    //store data in the studio complaints table which takes from database
                                    $table2 = "<table style='min-width:80%; max-width:80%;'>";                                  
                                    $table2 .= "<tr><th>studio(from)</th><th>customer(to)</th><th>studio-email</th><th>customer-email</th><th>description</th><th>slove</th>";
                                    while($record =mysqli_fetch_assoc($result_set2)){                                                 
                                        $complaint_id=$record['complaint_id'];
                                        $table2 .= "<tr>";
                                            $table2.= "<td>".$record['studio_name']."</td>";
                                            $table2.= "<td>".$record['first_name']."</td>";
                                            $table2.= "<td>".$record['s_email']."</td>";
                                            $table2.= "<td>".$record['email']."</td>";
                                            $table2.= "<td>".$record['com_description']."</td>";
                                            $table2 .= "<td>"."<form action=complaint.php?stud_complaint_id=$complaint_id method='post' ><button type='submit' name='solve'>SOLVED</button></form>"."</td>";
                                        $table2.= "</tr>";
                                    }
                                    $table2.= "</table>";

                                }

                            
                        
                            }                   
     

    ?>

<!DOCTYPE html>
<html>
<title>Complaints</title>
<head>
   <link rel="stylesheet" type="text/css" href="css/admin.css">  
   <?php  require_once('inc/navbar.php'); ?>
   
</head>
<body>
    <div class="row" >
         <div class="section"> 
            
                <?php 
                
                if(!empty($errors1)){
                    foreach($errors1 as $error){
                        echo '<div class="error">';
                        echo $error . '<br>';
                        echo '</div>';
                    }
                }else{
                    echo "<h2 style='padding:20px;'>Customers' Complaints</h2>";
                    echo $table1;
                }       
                
                
            ?>

        

        </div>
        <div class="section" >
                        
                            <?php 
                                if(!empty($errors2)){
                                    foreach($errors2 as $error){
                                    echo '<div class="error">';
                                    echo $error . '<br>';
                                    echo '</div>';
                                    }
                                    
                            }
                            else{
                                echo "<h2 style='padding:20px;'>Studios' Complaints</h2>";
                                echo $table2;
                            }
                            ?>

                        
                    
        </div>
</div>
</body>
</html>

<?php
     require_once('../inc/connection_close.php');
?>
  	


