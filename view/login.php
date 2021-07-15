<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
  <?php require_once('../inc/navbar.php'); ?>
    <div class="center">
      <h1>Login</h1>

      <form method="post" action="../controller/login.php">
        <div class="textfield">
          <!-- <input type="text" required name="username"> -->
          <input type="text" name="username" placeholder="">
          <span></span>
          <label>Username</label>
        </div>

        <div class="textfield">
          <!-- <input type="password" required name="password"> -->
          <input type="password" name="password" placeholder="">
          <span></span>
          <label>Password</label>
        </div>
        <div class="error">
            <?php
                if(isset($_GET['errors']) && !empty($_GET['errors'])){
                    $str_arr = unserialize(urldecode($_GET['errors']));
                     foreach($str_arr as $error){
                        echo $error . '<br>';
                    }
                }
            ?>
        </div>

        <div class="sent">
            <?php
              if(isset($_GET['everified'])){
                $everified = $_GET['everified'];
                echo $everified;
              }  
            ?>          
        </div>

        <input type="submit" value="Login" name="submit">
		    <div class="pass1"><a class="pass" href="password_reset1.php">Forgot Password?</a></div>
        <div class="signup_link">
          No Existing Account? <a href="sign_up.php">Signup</a>
        </div>
      </form>
    </div>
  </body>
</html>
