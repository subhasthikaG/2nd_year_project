<?php
require_once('../inc/connection.php');
session_start();
?>
<?php 
            if(!isset($_GET['error'])){
                if(isset($_GET['studio_verify'])){
                    $x=$_GET['studio_verify'];
                    $query1="UPDATE studio SET verified='1' WHERE studio_id=$x";
                    $result_set1=mysqli_query($connection,$query1);
                    
                    //sending all approved email to the studio
                    $query6 = "SELECT s_email FROM studio WHERE studio_id=$x";
                    $result_set6 = mysqli_query($connection,$query6);
                    $record6 = mysqli_fetch_assoc($result_set6);
                    $appmail = $record6['s_email'];
                    $message='';

                    $to=$appmail;
                    $from='recordexonlineres@gmail.com';
                    $subject='Account is Approved!';
                    $message.='Your Account is Approved.<br>Now You are fully verified to use RecordEx!<br>';
                    $message.='Log in Here. http://localhost/REX/view/login.php';
                    $header="From: {$from}\r\nContent-Type: text/html;";

                    $send_result=mail($to,$subject,$message,$header);
                    header('Location: ../admin/adminhome.php');
                }
                  
                if(isset($_GET['owner_verify'])){
                    $y=$_GET['owner_verify'];
                    $query2="SELECT owner.e_mail,studio.s_email FROM owner INNER JOIN studio ON owner.owner_id=studio.owner_id WHERE studio.studio_id=$y";
                    $result_set2=mysqli_query($connection,$query2);
                      
                    if($result_set2){
                      $record2 = mysqli_fetch_assoc($result_set2);
                      $o_email = $record2['e_mail'];
                      $st_email = $record2['s_email'];
                      
                      $token=uniqid(md5(time()));

                      $query3 = "INSERT INTO owner_verification (email,st_email,token) VALUES ('$o_email','$st_email','$token')";
                      $result_set3 = mysqli_query($connection,$query3);

                      //send token to the email
                      $to=$o_email;
                      $from='recordexonlineres@gmail.com';
                      $subject='Owner Verification';
                      $message.='You are required to Verify your personal email address. Please click the link to verify.<br>';
                      $message.='http://localhost/REX/view/owner_verified.php?token='.$token . '&s_id='.$y;
                      $header="From: {$from}\r\nContent-Type: text/html;";

                      $send_result=mail($to,$subject,$message,$header);
                      header('Location: ../admin/adminhome.php');
                    }
                }

                if(isset($_GET['studio_reject'])){
                    $z = $_GET['studio_reject'];
                    $query7 = "SELECT s_email FROM studio WHERE studio_id=$z";
                    $result_set7 = mysqli_query($connection,$query7);
                    $record7 = mysqli_fetch_assoc($result_set7);
                    $rejmail = $record7['s_email'];
                    $query8 = "DELETE FROM studio WHERE studio_id=$z";
                    $result_set8 = mysqli_query($connection,$query8);
                    if($result_set8){
                        $to=$rejmail;
                        $from='recordexonlineres@gmail.com';
                        $subject='Your Account is Rejected!';
                        $message.='Sorry! Your Account is Rejected by the Admin Team.<br>';
                        $message.='Thank You For Choosing RecorEx!';
                        $header="From: {$from}\r\nContent-Type: text/html;";
  
                        $send_result=mail($to,$subject,$message,$header);    
                    }
                    header('Location: ../admin/adminhome.php');
                }

                    $query="SELECT studio.studio_id,studio.studio_name,studio.s_email,studio.s_tele_no,studio.owner_verified,owner.first_name,owner.e_mail,owner.tp_number FROM studio 
                    INNER JOIN owner ON owner.owner_id = studio.owner_id WHERE ((studio.verified = '0') AND (studio.email_verified = '1'))"; 
                    $result_set=mysqli_query($connection,$query);
                    if($result_set){
                        if(mysqli_num_rows($result_set)==0){
                            header('Location: adminhome.php?error=There is no pending studios');
                        }
                        else{
                            $table = "<table id='pending'>";
                            $table .= "<tr><th>Studio Name</th><th>Studio email</th><th>Studio contact</th><th>Owner</th><th>Owner email</th><th>Owner contact</th><th>Owner Verification</th><th>Account Verification</th><th>Ignore</th></tr>";
                            while($record =mysqli_fetch_assoc($result_set)){
                                $table .= "<tr>";
                                    $table .= "<td>".$record['studio_name']."</td>";
                                    $table .= "<td>".$record['s_email']."</td>";
                                    $table .= "<td>".$record['s_tele_no']."</td>";
                                    $table .= "<td>".$record['first_name']."</td>";
                                    $table .= "<td>".$record['e_mail']."</td>";
                                    $table .= "<td>".$record['tp_number']."</td>";
                                    
                                    $query4 = "SELECT * FROM owner_verification WHERE email='{$record['e_mail']}' AND st_email='{$record['s_email']}'";
                                    $result_set4 = mysqli_query($connection,$query4);
                                    if(mysqli_num_rows($result_set4)==1){
                                        $table .= "<td>"."<button style='background:#737A76;'>Pending</button>"."</td>";    
                                      }
                                    else{
                                        if($record['owner_verified']==1){
                                          $table .= "<td>"."<button style='background:#13D32A;'>Done</button>"."</td>";     
                                        }
                                        else{
                                          $table .= "<td>"."<form action=adminhome.php?owner_verify=$record[studio_id] method='post' ><button type='submit' name='verify'>Send Mail</button></form>"."</td>";  
                                        }         
                                      }
                                    $table .= "<td>"."<button type='submit' onclick='verifyme($record[studio_id])'>Verify</button>"."</td>";
                                    $table .= "<td>"."<button type='submit' onclick='rejectme($record[studio_id])'>Reject</button>"."</td>";           
                                $table .= "</tr>";
                            }
                        }
                    }
              }
    ?>

 <script>
   function verifyme(verid){
     if(confirm('Are You Sure You Want to Verify this Account?')){
       window.location.href='adminhome.php?studio_verify=' +verid+'';
       return true;  
     }    
   }
   function rejectme(rejid){
     if(confirm('Are You Sure You Want to Reject this Account? (This account wil be completely deleted.)')){
       window.location.href='adminhome.php?studio_reject=' +rejid+'';
       return true;  
     }    
   }
   function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("pending");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
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
<title>admin dashboard</title>
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
  	


