<?php require_once('../inc/navbar.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Registration</title>
    <link rel="stylesheet" href="../css/customer/cust_reg.css">
    <style>
      .center{
        top: 55%;
      }
    </style>
</head>
<body>
    <div class="center">
    <h1>Are You?</h1>
    <form action="../view/owner_existence.php" method="post">
      <label class="rad">Already Registered Owner
        <input type="radio" name="existence" value="exist">
        <span class="checkmark"></span>
      </label>
      <label class="rad">New Owner
        <input type="radio" checked="checked" name="existence" value="notexist">
        <span class="checkmark"></span>
      </label>
      <input type="submit" value="Next" name="submit">
    </form>
    </div>  
    <?php require_once('../inc/minfooter.php');?>
</body>
</html>

<?php
  if(isset($_POST['submit'])){
    switch($_POST['existence']){
      case "exist":
          header('Location: ../view/owner_existform.php');
          break;
      case "notexist":
          header('Location: ../view/studio_reg_1.php');
          break;    
    }
  }