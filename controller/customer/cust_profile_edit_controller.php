<?php 
require_once('../../inc/connection.php');
session_start(); 
?>
<?php 
if(isset($_GET['c_id'])){//isset user_id which pass from form action 
    $c_id=$_GET['c_id'];//store user_id in a variable
    if(isset($_POST['submit_image'])){//check whether user press the save button in edit name
        $errors= array();  ////array of error
       
        if(empty($errors)){//if no errors
             $image = $_FILES['image']['name'];
             
           $query="UPDATE customer SET image='$image' WHERE  c_id=$c_id ";//update the details 
           $result_set=mysqli_query($connection,$query);   
            if($result_set){//if query succes 
                echo "yes";
                move_uploaded_file($_FILES['image']['tmp_name'],"../../img/customer/$image");
                header('Location: ../../view/customer/cust_profile.php');
            }    
            else{
                echo "no";
            }     
   
        }
        else{
            header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
        }
    }
    if(isset($_POST['submit_name'])){//check whether user press the save button in edit name
        $errors= array();  ////array of error
        if(!isset($_POST['first_name']) || strlen(trim($_POST['first_name']))<1){//form validation
            $errors[]='firstname is missing or invalid!';
        }
        if(!isset($_POST['last_name']) || strlen(trim($_POST['last_name']))<1){//form validation
            $errors[]='lastname is missing or invalid!';
        }
        if(empty($errors)){//if no errors
            //store form data in variables
            $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
    
            $query="UPDATE customer SET first_name='$first_name',last_name='$last_name'  WHERE  c_id=$c_id ";//update the details 
            $result_set=mysqli_query($connection,$query);   
            if($result_set){//if query succes 
                header('Location: ../../view/customer/cust_profile.php');
            }         
   
        }
        else{
            header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
        }
    }
    if(isset($_POST['submit_phone'])){//check whether user press the save button in edit mobile number
        $errors= array();  ////array of error
        if(!isset($_POST['tele_no']) || strlen(trim($_POST['tele_no']))<1){
            $errors[]='telephone number is missing or invalid!';
        }
        if(empty($errors)){//if no errors
            //store form data in variables
            $tele_no= mysqli_real_escape_string($connection,$_POST['tele_no']);
    
            $query="UPDATE customer SET tele_no='$tele_no' WHERE  c_id=$c_id ";//update phone number
            $result_set=mysqli_query($connection,$query);   
            if($result_set){
                header('Location: ../../view/customer/cust_profile.php');
            }         
   
        }
        else{
            header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
        }
    }
    if(isset($_POST['submit_password'])){//check whether user press the change password button in edit mobile number
        $errors= array();  ////array of error
        if(!isset($_POST['old_password']) || strlen(trim($_POST['old_password']))<1){
            $errors[]="old password is missing or invlid!";
            header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
        }
        else{
            $query="SELECT password FROM customer WHERE c_id = $c_id"; //query to get the password of the logged customer 
            $result_set=mysqli_query($connection,$query);
            if($result_set){
                            $record =mysqli_fetch_assoc($result_set);
                            if(sha1($_POST['old_password'])!=$record['password']){
                                $errors[]="password is incorrect";
                                header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
                            }else{
                                if(!isset($_POST['password']) || strlen(trim($_POST['password']))<8){
                                    $errors[]="Password must contain at least 8 characters.";
                                }
                                else if(!isset($_POST['new_password']) || strlen(trim($_POST['new_password']))<8){
                                    $errors[]="Password must contain at least 8 characters.";
                                }
                                else{
                                    //check password and new password is equel
                                    if($_POST['new_password']!=$_POST['password']){
                                        $errors[]='Password does not match';
                                    }
                        
                                }
                        
                                if(empty($errors)){//if no errors
                                    //store form data in variables
                                    $password= mysqli_real_escape_string($connection,$_POST['new_password']);
                                    $hashed_password = sha1($password);
                            
                                    $query1="UPDATE customer SET password='$hashed_password' WHERE  c_id=$c_id ";//update passoword
                                    $result_set1=mysqli_query($connection,$query1);   
                                    if($result_set1){
                                        header('Location: ../../view/customer/cust_profile.php');
                                    }         
                           
                                }
                                else{
                                    header('Location: ../../view/customer/cust_profile.php?errors='.urlencode(serialize($errors)));
                                }

                            }
                    
            }
            else{
                echo "sds";
            }

        }

    }


}



?>