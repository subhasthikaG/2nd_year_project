<?php
     require_once('../../inc/connection.php');
     session_start();

?>
<?php 
    if(isset($_SESSION['c_id']) && isset($_SESSION['user_id'])){
        $studio_id = $_SESSION['user_id'];         
        $c_id =$_SESSION['c_id'];

       
        if(isset($_POST['submit'])) {//check the submit button is pressed
            $msg = $_POST['msg'];
            $date = date("Y/m/d");				
            $query1="INSERT INTO messages (c_id,s_id,incoming_msg,date) VALUES ('{$c_id}','{$studio_id}','{$msg}','{$date}')";
            $result_set1 = mysqli_query($connection,$query1);
            if($result_set1){
                
                header('Location: ../../view/studio/studio_chat.php?c_id='.$c_id.'');
            }
          
        }
    }
    else{
        echo "no";
    }

?>
