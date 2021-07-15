<?php 
require_once('../../inc/connection.php');
session_start();
if($_GET['studio_id']){
    $studio_id= $_GET['studio_id'];
    $_SESSION['studio_id']=$studio_id;
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>chat</title>
	<link rel="stylesheet"  href="../../css/inbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function(){
            $("#chat").load(" #chat");
            setInterval(function() {
                $("#chat").load(" #chat");
            }, 2000);
        });
 
    </script>
</head>
<?php require_once('../../inc/cust_dash_navbar.php');?>
<div class="myclass">

	<div class="wrapper">
		<section class="chat-area">
			<header>
                    <?php 
            
                        $query1="SELECT * FROM studio WHERE studio_id = $studio_id"; //query to get data of the studio which customer going to mesaage
                        $result_set1=mysqli_query($connection,$query1);
                        if($result_set1){
                                        $record1 = mysqli_fetch_assoc($result_set1);			
                                
                        }
                    ?>
                    <a href="cust_inbox.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>				
					<img src="../../img/studio/<?php echo $record1['profile']?>" alt="">
					<div class="details">
					<span><?php echo $record1['studio_name'] ?></span>
					<p><?php echo $record1['status']?> </p>						
					</div>				
			</header>	
            <div class="chat-box" id= "chat">
                <?php 
                    $query2="SELECT * FROM messages WHERE c_id=$user_id AND s_id=$studio_id ORDER BY msg_id ASC"; //query to get all the message of logged user 
                    $result_set2=mysqli_query($connection,$query2);

                    $query3="SELECT profile FROM studio WHERE studio_id=$studio_id";
                    $result_set3=mysqli_query($connection,$query3);
                    $record3=mysqli_fetch_assoc($result_set3);

                  
                    if(mysqli_num_rows($result_set2)>0){
                        while($record2=mysqli_fetch_assoc($result_set2)){
                            if($record2['outgoing_msg']){
                                echo '
                                    <div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$record2['outgoing_msg'].'</p>
                                    </div>
                                     </div>
                                ';
                            }
                            elseif($record2['incoming_msg']){
                                echo '
                                    <div class="chat incoming">
                                    <img src="../../img/studio/'.$record3['profile'].'" alt="" class="">
                                    <div class="details">
                                        <p>'.$record2['incoming_msg'].'</p>
                                    </div>
                                    </div>  
                                ';
    
                            }
    
                        }

                    }
                    else{
                       echo '<center><p>No massages are available</p> </center>'; 

                    }
                    

                ?>

      
      
            </div>
            <form action="../../controller/customer/cust_inbox_controller.php"  method="post" class="typing-area">
                <input type="text" name="msg" id="inputMsg" placeholder="Type a massage here"  onkeyup='saveValue(this);'>
                <button type="submit" name="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>		
		</section>
	</div>

	<?php require_once('../../inc/minfooter.php'); ?>
	
</div>
</html>