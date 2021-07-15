<?php require_once('../inc/connection.php'); ?>
<?php session_start(); ?>

<?php
  if(isset($_POST['submit'])){
    if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
      $error = "Field is missing!";
      header('Location: ../view/s_email_ver_password.php?error='.$error);   
    }
    else{
      if(isset($_SESSION['s_ver_email'])){
        $email = $_SESSION['s_ver_email'];
        $query = "SELECT * FROM studio WHERE s_email = '$email'";
        $result_set = mysqli_query($connection,$query);
        $record = mysqli_fetch_assoc($result_set);
        $db_pass = $record['password'];
        $pass = $_POST['password'];
        $hashed_pass = sha1($pass);
        if($hashed_pass==$db_pass){
          $update_query = "UPDATE studio SET email_verified=1 WHERE s_email='$email'";
          $update_result = mysqli_query($connection,$update_query); 
          $delete_query = "DELETE FROM email_verification WHERE email='$email'";
          $delete_result = mysqli_query($connection,$delete_query);
          session_unset();
          session_destroy();
          $semailverified = 'Your Email is now Verified!<br>We will notify you when the Account is Approved.';
          header('Location: ../view/s_email_success.php?sev='.$semailverified);
        }
        else{
          $error = "Invalid Password!";
          header('Location: ../view/s_email_ver_password.php?error='.$error);  
        }  
      }   
    }
  }
?>