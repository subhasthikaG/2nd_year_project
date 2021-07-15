<?php session_start(); ?>
<?php require_once('../inc/connection.php'); ?>
<?php
   if(isset($_POST['submit'])){//check the submit button is pressed
           $errors= array();
           if(!isset($_POST['username']) || strlen(trim($_POST['username']))<1 || !isset($_POST['password']) || strlen(trim($_POST['password']))<1){
             $errors[]='username or password is missing or invalid';
           }
        if(empty($errors)){
             $username = mysqli_real_escape_string($connection,$_POST['username']);
             $password = mysqli_real_escape_string($connection,$_POST['password']);

            $query1 = "SELECT * FROM admin WHERE user_name = '{$username}' AND password ='{$password}'";
            $result_set1 = mysqli_query($connection,$query1);
            if($result_set1){
                    if(mysqli_num_rows($result_set1)==1){
                       $record =mysqli_fetch_assoc($result_set1);
                       $_SESSION['username']= $record['user_name'];
                        header('Location: adminhome.php');
                    }
                    else{
                        $errors[]="invalid username or password";
                        header('Location: index.php?errors='.urlencode(serialize($errors)));
                    }

            }
            else{
               header('Location: index.php?errors='.urlencode(serialize($errors)));

            }
    
         }
 }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Log In</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <div class="center">
      <h1>Admin Login</h1>

      <form method="post" action="index.php">
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
                else{

                }
            ?>
        </div>

        <input type="submit" value="Login" name="submit">
		</form>
    </div>
  </body>
</html>
<?php require_once('../inc/connection_close.php') ?>
