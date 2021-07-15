<?php
  require_once('../inc/connection.php');
  require_once('../inc/navbar.php');
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Registration</title>
    <link rel="stylesheet" href="../css/customer/cust_reg.css">
</head>
<body>
  <div class="center">
    <h1>Owner Registration</h1>
    <form action="../view/owner_existform.php" method="post">
      <div class="textfield">
        <input type="email" name="email">
        <span></span>
        <label>Existing Email</label>  
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
  <?php require_once('../inc/minfooter.php');?>
</body>
</html>

<?php 
  if(isset($_POST['submit'])){
      $email = $_POST['email'];
      $query = "SELECT * FROM owner WHERE e_mail='{$email}'";
      $result_set = mysqli_query($connection,$query);
      
      if(mysqli_num_rows($result_set)==1){
        $record = mysqli_fetch_assoc($result_set);
        $_SESSION['user_id']=$record['owner_id'];
        $_SESSION['user_name']=$record['first_name'];
        header('Location: ../view/studio_reg_2.php'); 
      } 
      else{
        if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
          $error = "Field is missing!";
          header('Location: ../view/owner_existform.php?error='.$error);
        }
        else{
          $error = "Email not Exists!";
          header('Location: ../view/owner_existform.php?error='.$error);  
        }
      } 
  }
?>