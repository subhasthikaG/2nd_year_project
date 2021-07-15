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
            $hashed_password = sha1($password);

            $query1 = "SELECT * FROM customer WHERE email = '{$username}' AND password ='{$hashed_password}'";
            $result_set1 = mysqli_query($connection,$query1);
            if($result_set1){
                    if(mysqli_num_rows($result_set1)==1){
                        $record =mysqli_fetch_assoc($result_set1);
                        if($record['email_verified']==1 && $record['blocked']==0){
                            $_SESSION['user_id']= $record['c_id'];
                            $_SESSION['username']=$record['first_name'];
                            header('Location: ../view/customer/cust_dash.php');
                        }
                        else{
                            $errors[]="sorry! Your Account is not Ready to Use.";
                            header('Location: ../view/login.php?errors='.urlencode(serialize($errors)));
                        }

                    }
                    else{
                        $query2 = "SELECT * FROM studio WHERE s_email = '{$username}' AND password ='{$hashed_password}'";
                        $result_set2 = mysqli_query($connection,$query2);
                        if($result_set2){
                            if(mysqli_num_rows($result_set2)==1){
                                $record =mysqli_fetch_assoc($result_set2);
                                if($record['email_verified']==1 && $record['verified']==1 && $record['blocked']==0){
                                    $_SESSION['user_id']= $record['studio_id'];
                                    $_SESSION['username']=$record['studio_name'];
                                    header('Location: ../view/studio/studio_dash.php');
                                }
                                else{
                                    $errors[]="Sorry! Your Account is not Ready to Login.";
                                    header('Location: ../view/login.php?errors='.urlencode(serialize($errors)));

                                }
                            }
                            else{

                                $errors[]="invalid username or password";
                                header('Location: ../view/login.php?errors='.urlencode(serialize($errors)));
                            }

                        }

                    }
            }

        }
        else{
            header('Location: ../view/login.php?errors='.urlencode(serialize($errors)));

        }
    }

?>
<?php require_once('../inc/connection_close.php') ?>
