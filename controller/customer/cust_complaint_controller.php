
<?php
require_once('../../inc/connection.php');
session_start();

if(isset($_SESSION['studio_id']) && isset($_SESSION['user_id'])){
        $c_id=$_SESSION['user_id'];
        $studio_id=$_SESSION['studio_id'];
        if(isset($_POST['submit'])){//check the submit button is pressed
                $errors= array();  ////array of errors
                //check form validation
                if(!isset($_POST['complaint']) || strlen(trim($_POST['complaint']))<1){
                    $errors[]='enter a complaint';
                }
                if(empty($errors)){//if no errors
                        //store form data in variables
                        $complaint= mysqli_real_escape_string($connection,$_POST['complaint']);
                        $query="INSERT INTO customer_complaint(c_id,studio_id,description) VALUES('{$c_id}','{$studio_id}','{$complaint}')";
                        $result_set=mysqli_query($connection,$query);
                        if($result_set){
                                $success="complaint added successfully";
                                header('Location: ../../view/customer/cust_complaint.php?success='.$success);
                        }
                        else{
                                echo "no";
                        }
                        
                }
                else{
                        header('Location: ../../view/customer/cust_complaint.php?errors='.urlencode(serialize($errors)));
                }  
        }
}
?>