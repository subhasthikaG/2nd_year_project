<?php
     require_once('../../inc/connection.php');
     session_start();

?>
<?php 
    if(isset($_SESSION['studio_id']) && isset($_SESSION['user_id'])){
        $studio_id = $_SESSION['studio_id'];         
        $cust_id =$_SESSION['user_id'];
        echo $studio_id;
        echo $cust_id;
       
        if(isset($_POST['submit'])) {//check the submit button is pressed
            $msg = $_POST['msg'];
            echo $msg;
            $date = date("Y/m/d");
            echo $date;				
            $query="INSERT INTO messages(c_id,s_id,outgoing_msg,date) VALUES('{$cust_id}','{$studio_id}','{$msg}','{$date}')";
            $result_set = mysqli_query($connection,$query);
            if($result_set){
                 header('Location: ../../view/customer/cust_chat.php?studio_id='.$studio_id.'');
            }
            else{
                echo "no";
            }

        
          
        }
 
    }


?>
