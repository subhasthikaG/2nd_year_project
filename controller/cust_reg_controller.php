<?php
     require_once('../inc/connection.php');

?>
<?php session_start();?>

 <?php
    if(isset($_POST['submit'])){//check the submit button is pressed
        $errors= array();  ////array of errors
        //check form validation
        if(!isset($_POST['first_name']) || strlen(trim($_POST['first_name']))<1){
            $errors[]='Something is missing or invalid!';
        }
        else if(!isset($_POST['last_name']) || strlen(trim($_POST['last_name']))<1){
            $errors[]='Sometihng is missing or invalid!';
        }
        else if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
            $errors[]='Something is missing or invalid!';
        }
        else if(!isset($_POST['tele_no']) || strlen(trim($_POST['tele_no']))<1){
            $errors[]='Something is missing or invalid!';
        }
        else if(!isset($_POST['password']) || strlen(trim($_POST['password']))<8){
            $errors[]='Password must contain at least 8 characters!';
        }
        else if(!isset($_POST['repeat_password']) || strlen(trim($_POST['repeat_password']))<8){
            $errors[]='Password must contain at least 8 characters!';
        }
        else{
            //check password and repeat password is equel
            if($_POST['repeat_password']!=$_POST['password']){
                $errors[]='Passwords are not matching!';
            }

        }

        if(empty($errors)){//if no errors
            //store form data in variables
            $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
            $email= mysqli_real_escape_string($connection,$_POST['email']);
            $tele_no= mysqli_real_escape_string($connection,$_POST['tele_no']);
            $password = mysqli_real_escape_string($connection,$_POST['repeat_password']);
            $hashed_password = sha1($password);

            //query to check already registered users
            $query1 = "SELECT * FROM customer WHERE email = '{$email}'";
            $result_set1 = mysqli_query($connection,$query1);
            $query12 = "SELECT * FROM studio WHERE s_email = '{$email}'";//customer email shouldn't exist in studio table 
            $result_set12 = mysqli_query($connection,$query12);
            $query13 = "SELECT * FROM removed_users WHERE email = '{$email}'";
            $result_set13 = mysqli_query($connection,$query13);

            if($result_set1){

                if((mysqli_num_rows($result_set1)==1)||(mysqli_num_rows($result_set12)==1)){
                    $errors[] = "This Email is already registered";
                    header('Location: ../view/cust_reg.php?errors='.urlencode(serialize($errors)));
                }

                else if(mysqli_num_rows($result_set13)==1){
                    $errors[] = "Email Blocked!";
                    header('Location: ../view/cust_reg.php?errors='.urlencode(serialize($errors)));
                }

                else{
                    //store form data in the database (scustomer table)
                    $query2 = "INSERT INTO customer (first_name,last_name,email,tele_no,password) VALUES ('{$first_name}','{$last_name}','{$email}','{$tele_no}','{$hashed_password}')";
                    $result_set2 = mysqli_query($connection,$query2);
                    if($result_set2){
                        //query to take data to make session
                        $query3 = "SELECT c_id,first_name FROM customer WHERE email ='{$email}' AND password ='{$hashed_password}'";
                        $result_set3 = mysqli_query($connection,$query3);
                         if($result_set3){
                                $record =mysqli_fetch_assoc($result_set3);
                                //make session
                                $_SESSION['user_id']= $record['c_id'];
                                $_SESSION['username']=$record['first_name'];

                                $token=uniqid(md5(time()));

                                $query1 = "INSERT INTO email_verification (email,token) VALUES ('$email','$token')";
                                $result1 = mysqli_query($connection,$query1);

                                //send token to the email
                                $to=$email;
                                $from='recordexonlineres@gmail.com';
                                $subject='Email Verification';
                                $message.='Click This Link to Verify Your Email.<br>Thank You!';
                                $message.='http://localhost/REX/view/email_success.php?token='.$token;
                                $header="From: {$from}\r\nContent-Type: text/html;";

                                $send_result=mail($to,$subject,$message,$header);

                                //next page
                                header('Location: ../view/customernext.php');
                          }
                         else{
                            //$errors[]="invalid username/password";
                          }
                    }
                }
            }
            else{

                $errors[] ='query error';
            }
        }
        else{
            header('Location: ../view/cust_reg.php?errors='.urlencode(serialize($errors)));
        }
    }
    else{

    }
?>

<?php
     require_once('../inc/connection_close.php');
?>
