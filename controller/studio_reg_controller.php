<?php
     require_once('../inc/connection.php');

?>
<?php session_start();?>
<?php
    if(isset($_POST['submit2'])){//check the submit button is pressed

        $errors=''; //array of errors
        $iserror=0;
        if(!isset($_POST['studio_name']) || strlen(trim($_POST['studio_name']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['s_address_1']) || strlen(trim($_POST['s_address_1']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['s_address_2']) || strlen(trim($_POST['s_address_2']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['s_city']) || strlen(trim($_POST['s_city']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['distric']) || strlen(trim($_POST['distric']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['postalcode']) || strlen(trim($_POST['postalcode']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['s_email']) || strlen(trim($_POST['s_email']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['s_tele_no']) || strlen(trim($_POST['s_tele_no']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['paypal']) || strlen(trim($_POST['paypal']))<1){
            $errors='Something is missing or invalid';
            $iserror = 1;
        }
        if(!isset($_POST['password']) || strlen(trim($_POST['password']))<8){
            $errors='Password must contain at least 8 characters';
            $iserror = 1;
        }
        if(!isset($_POST['repeat_password']) || strlen(trim($_POST['repeat_password']))<8){
            $errors='Password must contain at least 8 characters';
            $iserror = 1;
        }
        else{
          //check password and repeat password is equel
            if($_POST['repeat_password']!=$_POST['password']){
              $errors='Passwords are not matching!';
              $iserror=1;
           }
        }

        if($iserror==0){ //if no errors

            //store form data in variables
            $studio_name = mysqli_real_escape_string($connection,$_POST['studio_name']);
            $s_address_line1 = mysqli_real_escape_string($connection,$_POST['s_address_1']);
            $s_address_line2 = mysqli_real_escape_string($connection,$_POST['s_address_2']);
            $s_city = mysqli_real_escape_string($connection,$_POST['s_city']);
            $distric = mysqli_real_escape_string($connection,$_POST['distric']);
            $postalcode = mysqli_real_escape_string($connection,$_POST['postalcode']);
            $latitude = mysqli_real_escape_string($connection,$_POST['latitude']);
            $longitude = mysqli_real_escape_string($connection,$_POST['longitude']);
            $s_email = mysqli_real_escape_string($connection,$_POST['s_email']);
            $s_tele_no = mysqli_real_escape_string($connection,$_POST['s_tele_no']);
            $paypal = mysqli_real_escape_string($connection,$_POST['paypal']);
            $password = mysqli_real_escape_string($connection,$_POST['repeat_password']);
            $hashed_password = sha1($password);

        //query to take the studio_id
        //$query1 = "SELECT * FROM owner WHERE owner_id = '{$_SESSION['user_id']}'";
        //$result_set1 = mysqli_query($connection,$query1);

        $query1 = "SELECT * FROM studio WHERE s_email = '{$s_email}'";
        $result_set1 = mysqli_query($connection,$query1);
        $query12 = "SELECT * FROM customer WHERE email = '{$s_email}'";
        $result_set12 = mysqli_query($connection,$query12);
        $query13 = "SELECT * FROM removed_users WHERE email = '{$s_email}'";
        $result_set13 = mysqli_query($connection,$query13);    

            if($result_set1){
                if((mysqli_num_rows($result_set1)==1)||(mysqli_num_rows($result_set12)==1)){
                    $errors = "This Email is already registered";
                    header('Location: ../view/studio_reg_2.php?errors='.urlencode(serialize($errors)));
                }

                else if(mysqli_num_rows($result_set13)==1){
                    $errors = "Email Blocked!";
                    header('Location: ../view/studio_reg_2.php?errors='.urlencode(serialize($errors)));
                }    

                else{
                    $query2 = "INSERT INTO studio(studio_name,s_address_line1,s_address_line2,s_city,distric,postalcode,latitude,longitude,s_email,password,s_tele_no,paypal,owner_id)
                    VALUES ('{$studio_name}','{$s_address_line1}','{$s_address_line2}','{$s_city}','{$distric}','{$postalcode}','{$latitude}','{$longitude}','{$s_email}','{$hashed_password}','{$s_tele_no}','{$paypal}','{$_SESSION['user_id']}')";

                    $result_set2 = mysqli_query($connection,$query2);
                    if($result_set2){
                        $token=uniqid(md5(time()));

                        $query1 = "INSERT INTO email_verification (email,token) VALUES ('$s_email','$token')";
                        $result1 = mysqli_query($connection,$query1);

                        //send token to the email
                        $to=$s_email;
                        $from='recordexonlineres@gmail.com';
                        $subject='Email Verification';
                        $message.='Click This Link to Verify Your Email.';
                        $message.='http://localhost/REX/view/s_email_success.php?token='.$token;
                        $header="From: {$from}\r\nContent-Type: text/html;";

                        $send_result=mail($to,$subject,$message,$header);

                        //next page
                        header('Location: ../view/customernext.php');
                  }
                  else{

                  }
                }
            }     
        else{
            header('Location: ../view/studio_reg_2.php?errors='.urlencode(serialize($errors)));
        }
    }
    else{
        header('Location: ../view/studio_reg_2.php?errors='.urlencode(serialize($errors)));  
    }
} 
?>
