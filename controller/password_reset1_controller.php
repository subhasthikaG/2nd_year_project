<?php require_once('../inc/connection.php');?>
<?php session_start();?>
<?php
  $alert='';
  if(isset($_POST['send'])){
    $email=$_POST['email'];
    $query1="SELECT email FROM customer WHERE email='$email'";
    $result1=mysqli_query($connection,$query1);
    $query2="SELECT s_email FROM studio WHERE s_email='$email'";
    $result2=mysqli_query($connection,$query2);
    if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
      $token=uniqid(md5(time()));

      $query3 = "SELECT email FROM tokens WHERE email='$email'";
      $result3 = mysqli_query($connection,$query3);

      if(mysqli_num_rows($result3)>0){
        $query = "UPDATE tokens SET token='$token' WHERE email='$email'";
        $insert_result = mysqli_query($connection,$query);
      }
      else{
        $query = "INSERT INTO tokens (email,token) VALUES ('$email','$token')";
        $insert_result = mysqli_query($connection,$query);
      }


      //send token to the Email
      $to=$email;
      $from='recordexonlineres@gmail.com';
      $subject="Password Reset";
      $message='We have got your request to reset your password.<br>';
      $message.='Please follow the URL to reset your password.<br>';
      $message.='http://localhost/REX/view/password_reset2.php?token='.$token;
      $header="From: {$from}\r\nContent-Type: text/html;";

      $send_result=mail($to,$subject,$message,$header);

      if($send_result)
          $alert="<div class='sent'>Password request link sent to your email.<br>Please follow the link!</div>";
      else
          $alert="<div class='failed'>Failed to send the mail!</div>";
  }
  else
    $alert="<p class='error'>Email is not Valid!</p>";
    }

    // if(isset($_POST['send'])){
    //     $_SESSION['alert']= $alert;
    //     header('Location: ../view/password_reset1.php');
    // }
    $_SESSION['alert']=$alert;
    header('Location: ../view/password_reset1.php');
 ?>
