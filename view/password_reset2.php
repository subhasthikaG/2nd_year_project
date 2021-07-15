
<?php
require_once('../inc/connection.php');
$alert='';
if(isset($_GET['token'])){
  $token=$_GET['token'];
      $ret_query = "SELECT email FROM tokens WHERE token='$token'";
      $ret_result = mysqli_query($connection,$ret_query);
      if(mysqli_num_rows($ret_result)<1){
        $errors[] = 'Link not Existing. Please Try Again!';
        header('Location: ../view/login.php?errors='.urlencode(serialize($errors)));
      }
      session_start();
      $_SESSION['token']= $token;
  }

else{
  header('Location: ../view/password_reset1.php');
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../assets/pass_length.js"></script>
    <style media="screen">
    input[type="submit"]{
      margin: 0 0 20px 0;
    }
    </style>
  </head>
  <body>
    <?php require_once('../inc/navbar.php');?>
    <div class="center">
      <h1>Verify Email</h1>
      <form class="" action="../controller/password_reset2_controller.php" method="post">
        <div class="textfield">
          <input type="password" name="password" id="pass1" onkeyup="checkPass(); return false;">
          <span></span>
          <label>Password <span id="error-nwl1"></span></label>
        </div>

        <div class="textfield">
          <input type="password" name="re-password" id="pass2" onkeyup="checkPass(); return false;">
          <span></span>
          <label>Re-Password <span id="error-nwl2"></span></label>
        </div>

        <div class="error">
          <?php
          echo $alert;
          $alert='';

          if(isset($_SESSION['alert'])){
            $alert = $_SESSION['alert'];
          }

          echo $alert;
          $alert='';
          ?>
        </div>
        <input type="submit" name="reset" value="reset">
      </form>
    </div>
  </body>
</html>
