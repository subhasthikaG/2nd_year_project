<?php 
require_once('../../inc/connection.php');
session_start();
?>
	<meta charset="utf-8">
	<title>Inbox</title>
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
	<?php require_once('../../inc/stu_dash_navbar.php');?>	

<div class="myclass">
	<div class="wrapper">
		<section class="users">
			<header>
				<?php 	

					$query1="SELECT * FROM studio WHERE studio_id = $user_id"; //query to get data of the logged studio ($user id is included from cust_dash_navbar.php)
					$result_set1=mysqli_query($connection,$query1);
					if($result_set1){
									$record1 = mysqli_fetch_assoc($result_set1);			
							
					}
					else{
						echo "no";
					}
					

				?>
				<div class="content">
					<img src="../../img/studio/<?php echo $record1['profile']?>" alt="">
					<div class="details">
					<span><?php echo $record1['studio_name'] ?></span>
					<p><?php // echo $record1['status']?> </p>					
					</div>
				</div>
			</header>
			<div class="search">
				<span class="text"></span>
		
			</div>
			<div class="users-list" id="chat">
				 <?php 				 			
					$query2="SELECT DISTINCT customer.c_id,customer.first_name,customer.image FROM customer INNER JOIN  messages ON customer.c_id=messages.c_id WHERE messages.s_id=$user_id  ORDER BY messages.msg_id DESC ";
					$result_set2=mysqli_query($connection,$query2);
					if(mysqli_num_rows($result_set2)>0){						
						while($record2=mysqli_fetch_assoc($result_set2)){
							$query3="SELECT * FROM messages WHERE s_id=$user_id AND c_id=$record2[c_id] ORDER BY msg_id DESC LIMIT 1"; //query to get letest msg of perticular studio and customer
							$result_set3=mysqli_query($connection,$query3);
							$record3=mysqli_fetch_assoc($result_set3);
							if($record3['incoming_msg']){ 
								$latest=$record3['incoming_msg'];
							}
							else{
								$latest=$record3['outgoing_msg'];
							}
							echo '	
									<a href="studio_chat.php?c_id='.$record2['c_id'].'" alt="">
									<div class="content">
									<img src= "../../img/customer/'.$record2['image'].'"   alt="">
									<div class="details">
									<span>'.$record2['first_name'].'</span>
									<p>'.$latest.'</p>					
									</div>
									</div>
									<div class="status-dot"><i class="fas fa-circle"> </i></div>
									</a> 
							
							';

						}
					}
					
							
				 
				 ?>


			</div>
		</section>
	</div>
	<script src="../../assets/inbox.js"></script>
	<?php require_once('../../inc/minfooter.php'); ?>
	
</div>
</html>