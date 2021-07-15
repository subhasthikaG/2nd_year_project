<?php require_once('../inc/connection.php'); ?>
<?php session_start(); ?>

<?php
  if(isset($_POST['submit'])){
    if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
      $error = "Field is missing!";
      header('Location: ../view/owner_ver_password.php?error='.$error);    
    }
    else{
      if(isset($_SESSION['own_stu_id'])){
        $s_id = $_SESSION['own_stu_id'];
        $query = "SELECT * FROM studio WHERE studio_id= '$s_id'";
        $result_set = mysqli_query($connection,$query);
        $record = mysqli_fetch_assoc($result_set);
        $st_email = $record['s_email'];
        $db_pass = $record['password'];
        $pass = $_POST['password'];
        $hashed_pass = sha1($pass);
        if($hashed_pass==$db_pass){
          $query2 = "UPDATE studio SET owner_verified=1 WHERE studio_id='$s_id'";
          $result_set2 = mysqli_query($connection,$query2);
          $query3 = "DELETE FROM owner_verification WHERE st_email='$st_email'";
          $result_set3 = mysqli_query($connection,$query3); 
          session_unset();
          session_destroy();
          $ownerverified = 'Verification Successfull as an Owner!<br>We will notify you when the Account is Approved.';
          header('Location: ../view/owner_verified.php?owver='.$ownerverified); 
        }
        else{
          $error = "Invalid Password!";
          header('Location: ../view/owner_ver_password.php?error='.$error);    
        }
      }  
    }  
  }
?>