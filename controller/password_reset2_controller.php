<?php require_once('../inc/connection.php');
  session_start();
  $token= $_SESSION['token'];
  session_unset();
  session_destroy();
  echo $token.'<br>';
  ?>

<?php
  $alert='';
  $isalert=0;
  if(isset($_POST['reset'])){
      if((!isset($_POST['password'])) || (strlen(trim($_POST['password']))<8) || (!isset($_POST['re-password'])) || (strlen(trim($_POST['re-password'])))<8){
        $alert = 'Password must contain at least 8 characters!';
        $isalert=1;
    }

      else{
          $password = $_POST['password'];
          $re_password = $_POST['re-password'];

          if($password == $re_password){
              $ret_query = "SELECT email FROM tokens WHERE token='$token'";
              $ret_result = mysqli_query($connection,$ret_query);

              if(mysqli_num_rows($ret_result)==1){
                  $ret_array = mysqli_fetch_assoc($ret_result);
                  $email = $ret_array['email'];
                  $hash = sha1($password);
                  $update_query1 = "UPDATE customer SET password = '$hash' WHERE email='$email'";
                  $update_reult1 = mysqli_query($connection,$update_query1);
                  $update_query2 = "UPDATE studio SET password = '$hash' WHERE s_email='$email'";
                  $update_result2 = mysqli_query($connection,$update_query2);
                  $delete_query = "DELETE FROM tokens WHERE token='$token'";
                  $delete_result = mysqli_query($connection,$delete_query);
                  $resuc="Password Reset Successfull!";
                  header('Location: ../view/login.php?everified='.$resuc);
              }
              else{
                  $alert = 'Link not Existing. Please Try Again!';
                  $isalert=1;
              }
          }

        else{
          $alert = 'Passwords are not matched!';
          $isalert=1;
        }
      }
  }

  else{
    $alert = 'Reset Failed!';
    $isalert=1;
  }
  // session_start();
  // $_SESSION['alert'] = $alert;
  // $_SESSION['token'] = $token;
  // echo $_SESSION['alert'];

  if($isalert==1){
    session_start();
    $_SESSION['alert'] = $alert;
    // $_SESSION['token'] = $token;
    // echo $_SESSION['token'];
    echo 'hello';
    echo $token;
    header('Location: ../view/password_reset2.php?token='.$token);
  }
 ?>
