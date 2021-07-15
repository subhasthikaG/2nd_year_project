<?php 
require_once('../../inc/connection.php');
session_start(); 
?>

<?php
   if(isset($_GET['s_id'])){     
     $s_id = $_GET['s_id'];
      if(isset($_POST['submit_profile'])){//check whether user press the save button in edit name         
        $errors= array();  ////array of error
        if(empty($errors)){//if no errors          
          $profile = $_FILES['profile']['name'];             
          $query="UPDATE studio SET profile='$profile' WHERE  studio_id=$s_id ";//update the details 
          $result_set=mysqli_query($connection,$query);   
            if($result_set){//if query succes 
                move_uploaded_file($_FILES['profile']['tmp_name'],"../../img/studio/$profile");
                header('Location: ../../view/studio/studio_profile.php');
            }    
            else{
                echo "no";
            }     
  
        }
        else{
            header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
        }
      }
      if(isset($_POST['submit_cover'])){//check whether user press the save button in edit name        
        $errors= array();  ////array of error
        if(empty($errors)){//if no errors          
          $cover = $_FILES['cover']['name'];            
          $query="UPDATE studio SET cover='$cover' WHERE  studio_id=$s_id ";//update the details 
          $result_set=mysqli_query($connection,$query);   
            if($result_set){//if query succes                
                move_uploaded_file($_FILES['cover']['tmp_name'],"../../img/studio/$cover");
                header('Location: ../../view/studio/studio_profile.php');
            }    
            else{
                echo "no";
            }     
  
        }
        else{            
            header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
        }
      }

     if(isset($_POST['submit_des'])){
       $errors=array();
       if(!isset($_POST['description']) || strlen(trim($_POST['description']))<1){
         $errors[]='Text is missing!';
       }
       if(empty($errors)){
         $description = mysqli_real_escape_string($connection,$_POST['description']);
         $query = "UPDATE studio SET description='$description' WHERE studio_id='$s_id'";
         $result_set = mysqli_query($connection,$query);
         if($result_set){
           header('Location: ../../view/studio/studio_profile.php'); 
         }
       }
       else{
         header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));  
       }
     }
     
     if(isset($_POST['submit_port'])){
       $errors=array();
       if(empty($errors)){
         $port1 = mysqli_real_escape_string($connection,$_POST['port1']);
         $port2 = mysqli_real_escape_string($connection,$_POST['port2']);
         $port3 = mysqli_real_escape_string($connection,$_POST['port3']);
         $port4 = mysqli_real_escape_string($connection,$_POST['port4']);
         $query = "SELECT * FROM studio_portfolio WHERE studio_id = '$s_id'";
         $result_set = mysqli_query($connection,$query);
         if(mysqli_num_rows($result_set)==1){
           $query1 = "UPDATE studio_portfolio SET port1='$port1',port2='$port2',port3='$port3',port4='$port4'";
           $result_set1 = mysqli_query($connection,$query1);
           if($result_set1){
             header('Location: ../../view/studio/studio_profile.php');
           }  
         }
         else{
           $query1 = "INSERT INTO studio_portfolio (studio_id,port1,port2,port3,port4) VALUES ('$s_id','$port1','$port2','$port3','$port4')";
           $result_set1 = mysqli_query($connection,$query1);
           if($result_set1){
             header('Location: ../../view/studio/studio_profile.php');  
           }
         }
       }
       else{
         header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
       }
     }

     if(isset($_POST['submit_name'])){
       $errors = array();
       if(!isset($_POST['name']) || strlen(trim($_POST['name']))<1){//form validation
        $errors[]='Studio name is missing or invalid!';
        }
       if(empty($errors)){//if no errors
            //store form data in variables
            $studio_name = mysqli_real_escape_string($connection,$_POST['name']);
    
            $query="UPDATE studio SET studio_name='$studio_name' WHERE studio_id=$s_id";//update the details 
            $result_set=mysqli_query($connection,$query);   
            if($result_set){//if query succes 
                header('Location: ../../view/studio/studio_profile.php');
            }         
        }
       else{
            header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
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
      
            $query="UPDATE studio SET s_tele_no='$tele_no' WHERE studio_id=$s_id ";//update phone number
            $result_set=mysqli_query($connection,$query);   
            if($result_set){
                header('Location: ../../view/studio/studio_profile.php');
            }         
        }
       else{
            header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
          } 
     }

      if(isset($_POST['submit_address'])){
        $errors= array();
        if(!isset($_POST['add_1']) || strlen(trim($_POST['add_1']))<1){
          $errors[]='Something is missing or invalid format!';
        }
        else if(!isset($_POST['add_2']) || strlen(trim($_POST['add_2']))<1){
          $errors[]='Something is missing or invalid format!';
        }
        else if(!isset($_POST['City']) || strlen(trim($_POST['City']))<1){
          $errors[]='Something is missing or invalid format!';
        }
        // else if(!isset($_POST['dist']) || strlen(trim($_POST['dist']))<1){
        //   $errors[]='Something is missing or invalid format!';
        // }
        else if(!isset($_POST['post_code']) || strlen(trim($_POST['post_code']))<1){
          $errors[]='Something is missing or invalid format!';
        }
        if(empty($errors)){
          $add_1= mysqli_real_escape_string($connection,$_POST['add_1']);
          $add_2= mysqli_real_escape_string($connection,$_POST['add_2']);
          $city= mysqli_real_escape_string($connection,$_POST['City']);
          $dist= mysqli_real_escape_string($connection,$_POST['distric']);
          $post_code= mysqli_real_escape_string($connection,$_POST['post_code']);

          $query="UPDATE studio SET s_address_line1='$add_1', s_address_line2='$add_2', s_city='$city', distric='{$dist}', postalcode='$post_code' WHERE studio_id=$s_id";//update the details 
          $result_set=mysqli_query($connection,$query);
          if($result_set){
            header('Location: ../../view/studio/studio_profile.php');
          }  
        }
        else{
          header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
        }
      }

      if(isset($_POST['submit_location'])){
        $errors=array();
        if(!isset($_POST['latitude']) || strlen(trim($_POST['latitude']))<1){
          $errors[]='Something is missing or invalid!';
        }
        else if(!isset($_POST['longitude']) || strlen(trim($_POST['longitude']))<1){
          $errors[]='Something is missing or invalid!';
        }
        if(empty($errors)){
          $latitude= mysqli_real_escape_string($connection,$_POST['latitude']);
          $longitude= mysqli_real_escape_string($connection,$_POST['longitude']);

          $query="UPDATE studio SET latitude='$latitude',longitude='$longitude' WHERE studio_id=$s_id";
          $result_set= mysqli_query($connection,$query);
          if($result_set){
            header('Location: ../../view/studio/studio_profile.php');
          }
        }
        else{
          header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
        }
      }

      if(isset($_POST['submit_ow_password'])){
        $errors= array();  ////array of error
        if(!isset($_POST['old_password']) || strlen(trim($_POST['old_password']))<1){
          $errors[]="old password is missing or invlid!";
          header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
        }
        else{
          $query="SELECT password FROM studio WHERE studio_id = $s_id"; //query to get the password of the logged studio 
          $result_set=mysqli_query($connection,$query);
          if($result_set){
            $record =mysqli_fetch_assoc($result_set);
            if(sha1($_POST['old_password'])!=$record['password']){
              $errors[]="password is incorrect";
              header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
              }
            
            else{
              if(!isset($_POST['password']) || strlen(trim($_POST['password']))<8){
                $errors[]="password must contain at least 8 characters.";
                }
              if(!isset($_POST['new_password']) || strlen(trim($_POST['new_password']))<8){
                $errors[]="password must contain at least 8 characters.";
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
                          
                $query1="UPDATE studio SET password='$hashed_password' WHERE studio_id=$s_id ";//update passoword
                $result_set1=mysqli_query($connection,$query1);   
                if($result_set1){
                  header('Location: ../../view/studio/studio_profile.php');
                  }                          
                }
              else{
                header('Location: ../../view/studio/studio_profile.php?errors='.urlencode(serialize($errors)));
              }
            }
          }
        }
      }
    } 
   
?>