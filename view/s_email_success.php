<?php require_once('../inc/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail Verification</title>
    <style>
      body{
        
        background-image:linear-gradient(rgba(255,255,255,0.7),rgba(69, 109, 215,0.7)), url('../img/studio-mic.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .textbox{
        padding-top: 15%;
        text-align: center;
        font-family: cursive;
        font-size: 30px;
        color: white;
      }

      .invalid{
        color:red;
      }

      .button-container{
        padding-left: 45%;
        
      }

      .button {

        background-color: #1AB2E7;
        border: none;
        color: white;
        padding: 2% 2%;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-family: sans-serif;
        font-size: 100%;
        margin: 4px 2px;
        cursor: pointer;
      }  
    </style>
</head>
<body>
  <?php
    require_once('../inc/navbar.php');
    if(isset($_GET['token'])){
      $token = $_GET['token'];  
      $ret_query = "SELECT * FROM email_verification WHERE token='$token'";
      $ret_result = mysqli_query($connection,$ret_query);
      
      if(mysqli_num_rows($ret_result)==1){
        $record = mysqli_fetch_assoc($ret_result);
        $email = $record['email'];
        session_start();
        $_SESSION['s_ver_email'] = $email;
        header('Location: ../view/s_email_ver_password.php');
      }
      else{
        echo "<div class='textbox invalid'><h1 class='invalid'>INVALID LINK!</h1></div>";     
      }
    }
    else{
      if($_GET['sev']){
        $sev = $_GET['sev'];
        echo "<div class='textbox'><h1>$sev</h1></div>";
      }
      else{
        echo "<div class='textbox invalid'><h1 class='invalid'>INVALID LINK!</h1></div>";  
      }
      
    }
  ?>
    <div class="button-container">
		  <a href="home.php" class="button">Back to Home</a>
	</div>     
</body>
</html>