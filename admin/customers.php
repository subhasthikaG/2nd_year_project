<?php
require_once('../inc/connection.php');
?>

<?php
  if(!isset($_GET['errors'])){

    if(isset($_GET['cust_block'])){
      $x = $_GET['cust_block'];  
      $query2 = "UPDATE customer SET blocked = '1' WHERE c_id = $x";
      $result_set2 = mysqli_query($connection,$query2);
      header('Location: ../admin/customers.php');  
    }

    if(isset($_GET['cust_unblock'])){
      $y = $_GET['cust_unblock'];
      $query3 = "UPDATE customer SET blocked = '0' WHERE c_id = $y";
      $result_set3 = mysqli_query($connection,$query3);
      header('Location: ../admin/customers.php');   
    }

    if(isset($_GET['cust_remove'])){
      $z = $_GET['cust_remove'];
      $query11 = "SELECT email FROM customer WHERE c_id = $z";
      $result_set11 = mysqli_query($connection,$query11);
      $record = mysqli_fetch_assoc($result_set11);
      $email = $record['email'];
      $query12 = "INSERT INTO removed_users (email) VALUES ('{$email}')";
      $result_set12 = mysqli_query($connection,$query12);
      $query4 = "DELETE FROM customer WHERE c_id = $z";
      $result_set4 = mysqli_query($connection,$query4);
      header('Location: ../admin/customers.php');  
    }

    $query = "SELECT * FROM customer WHERE email_verified = 1";
    $result_set = mysqli_query($connection,$query);
    
    if($result_set){
      if(mysqli_num_rows($result_set)==0){
        header('Location: customers.php?error=There are no verified customers.');    
      }
      else{
        $table = "<table style='max-width:60%;' id='customers'>";
        $table .= "<tr><th>Customer ID</th><th>Customer Name</th><th>Email</th><th>Contact</th><th>Block</th><th>Remove</th></tr>";
        while($record =mysqli_fetch_assoc($result_set)){
          $table .= "<tr>";
          $table .= "<td>".$record['c_id']."</td>";
          $table .= "<td>".$record['first_name']." ".$record['last_name']."</td>";
          $table .= "<td>".$record['email']."</td>";
          $table .= "<td>".$record['tele_no']."</td>";
          if($record['blocked']==0){
            $table .= "<td>"."<form action=customers.php?cust_block=$record[c_id] method='post' ><button type='submit'>Block</button></form>"."</td>";  
          }
          else{
            $table .= "<td>"."<form action=customers.php?cust_unblock=$record[c_id] method='post' ><button style='background-color:red;' type='submit'>Unblock</button></form>"."</td>";    
          }
          $table .= "<td>"."<button type='submit' onclick='removeme($record[c_id])'>Remove</button>"."</td>";   
          $table .= "</tr>"; 
        }  
      }  
    }
  }
?>

<script>
  function removeme(remid){
    if(confirm('Are You Sure You Want to Remove this Account?')){
      window.location.href='customers.php?cust_remove=' +remid+'';
      return true;  
    }
  }

  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("customers");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        }
        else {
          tr[i].style.display = "none";
        }
      }       
    }
  }  
</script>

<!DOCTYPE html>
<html>
<title>verified studios</title>
<head>
   <link rel="stylesheet" type="text/css" href="css/admin.css">  
   <?php require_once('inc/navbar.php'); ?>
   
</head>
<body>
<div class="row"> 
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Customer Name.." title="Type in a Name">   
    <?php 
         if(isset($_GET['error'])){
            echo '<div class="error">';
               echo $_GET['error'];
            echo '</div>';
           }
           else{
            echo $table;
           }
    ?>
</div>
</body>
</html>

<?php require_once('../inc/connection_close.php'); ?>