<?php
require_once('../inc/connection.php');
session_start();
?>
<?php 
             if(!isset($_GET['error'])){
                    if(isset($_GET['studio_block'])){
                      $x = $_GET['studio_block'];  
                      $query2 = "UPDATE studio SET blocked = '1' WHERE studio_id = $x";
                      $result_set2 = mysqli_query($connection,$query2);
                      header('Location: ../admin/verified.php');  
                    }

                    if(isset($_GET['studio_unblock'])){
                      $y = $_GET['studio_unblock'];
                      $query3 = "UPDATE studio SET blocked = '0' WHERE studio_id = $y";
                      $result_set3 = mysqli_query($connection,$query3);
                      header('Location: ../admin/verified.php');   
                    }

                    if(isset($_GET['studio_remove'])){
                      $z = $_GET['studio_remove'];
                      $query11 = "SELECT s_email FROM studio WHERE studio_id = $z";
                      $result_set11 = mysqli_query($connection,$query11);
                      $record = mysqli_fetch_assoc($result_set11);
                      $email = $record['s_email'];
                      $query12 = "INSERT INTO removed_users (email) VALUES ('{$email}')";
                      $result_set12 = mysqli_query($connection,$query12);
                      $query4 = "DELETE FROM studio WHERE studio_id = $z";
                      $result_set4 = mysqli_query($connection,$query4);
                      header('Location: ../admin/verified.php');  
                    }

                    $query="SELECT studio.studio_id,studio.studio_name,studio.s_email,blocked,studio.s_tele_no,owner.first_name,owner.e_mail,owner.tp_number FROM studio 
                    INNER JOIN owner ON  owner.owner_id = studio.owner_id WHERE studio.verified = '1' "; 
                    $result_set=mysqli_query($connection,$query);
                    if($result_set){
                        if(mysqli_num_rows($result_set)==0){
                            header('Location: verified.php?error=There is no verified studios');
                        }
                        else{
                            $table = "<table id='verified'>";
                            $table .= "<tr><th>Studio ID</th><th>Studio Name</th><th>Studio email</th><th>Studio contact</th><th>Owner</th><th>Owner email</th><th>Owner contact</th><th>Block</th><th>Remove</th></tr>";
                            while($record =mysqli_fetch_assoc($result_set)){
                                $table .= "<tr>";
                                    $table .= "<td>".$record['studio_id']."</td>";
                                    $table .= "<td>".$record['studio_name']."</td>";
                                    $table .= "<td>".$record['s_email']."</td>";
                                    $table .= "<td>".$record['s_tele_no']."</td>";
                                    $table .= "<td>".$record['first_name']."</td>";
                                    $table .= "<td>".$record['e_mail']."</td>";
                                    $table .= "<td>".$record['tp_number']."</td>";                        
                                    if($record['blocked']==0){
                                      $table .= "<td>"."<form action=verified.php?studio_block=$record[studio_id] method='post' ><button type='submit'>Block</button></form>"."</td>";  
                                    }
                                    else{
                                      $table .= "<td>"."<form action=verified.php?studio_unblock=$record[studio_id] method='post' ><button style='background-color:red;' type='submit'>Unblock</button></form>"."</td>";    
                                    }
                                    $table .= "<td>"."<button type='submit' onclick='removeme($record[studio_id])'>Remove</button>"."</td>";                                        
                                $table .= "</tr>";
                            }
                        }
                    }
              }
    ?>

    <script>
      function removeme(remid){
        if(confirm('Are You Sure You Want to Remove this Account?')){
         window.location.href='verified.php?studio_remove=' +remid+'';
         return true;  
       }
      }

      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("verified");
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
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Studio Name.." title="Type in a Name">              
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

<?php
     require_once('../inc/connection_close.php');
?>
  	


