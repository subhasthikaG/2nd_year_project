<?php require_once('../../inc/connection.php'); 
 session_start(); ?>
<?php 
 
    if(isset($_POST['rate'])){
        if(isset($_SESSION['user_id'])){
            if(isset($_GET['studio_id'])){                
                $rate=$_POST['rate'];                
                $c_id=$_SESSION['user_id'];                
                $studio_id=$_GET['studio_id'];                
                $comment=$_POST['comment'];
               
                $query="INSERT INTO rate(c_id,studio_id,rate,comment) 
                        VALUES('{$c_id}','{$studio_id}','{$rate}','{$comment}')";
                $result_set=mysqli_query($connection,$query);
                if($result_set){
                    if(isset($_SESSION['job_id'])){
                        $job_id=$_SESSION['job_id'];
                        $query1="UPDATE reserved_job SET rated=1 WHERE job_id=$job_id";
                        $result_set1=mysqli_query($connection,$query1);
                        if($result_set1){
                            header('Location: ../../view/customer/pendings.php');

                        }
                    }
                }
                else{
                    
                }
    }
    else{
        echo "No";
    }
 }
}
else{
    echo "please select star";
}
 

?>