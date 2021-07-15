<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View</title>
    <link rel="stylesheet" href="../css/login.css">
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
      <form class="" action="../controller/email_ver_password_controller.php" method="post">
        <div class="textfield">
          <input type="password" name="password">
          <span></span>
          <label>Password</label>
        </div>

        <div class="error">
           <?php
             if(isset($_GET['error'])){
               echo $_GET['error'];       
             }
           ?> 
        </div>

        <input type="submit" name="submit" value="Next">
      </form>
    </div>
  </body>
</html>
