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
	<?php require_once('../../inc/cust_dash_navbar.php');?>	

<div class="myclass">
	<div class="wrapper">
		<section class="users">
			<header>
				<?php 

					$query1="SELECT * FROM customer WHERE c_id = $user_id"; //query to get data of the logged customer ($user id is included from cust_dash_navbar.php)
					$result_set1=mysqli_query($connection,$query1);
					if($result_set1){
									$record1 = mysqli_fetch_assoc($result_set1);			
							
					}
				?>
				<div class="content">
					<img src="../../img/customer/<?php echo $record1['image']?>" alt="">
					<div class="details">
					<span><?php echo $record1['first_name']." ".$record1['last_name'] ?></span>
					<p><?php //echo $record1['status']?> </p>					
					</div>
				</div>
			</header>
			<form>
			<div class="search_div" >
				
				<!-- <button><i class="fas fa-search"></i></button> -->
				<input type="text" placeholder="Find the studio... " onkeyup="live_search(this.value)">
				
				<div id="search">
				
				</div>
			</div>
			</form>
			<div class="users-list" id="chat">
				 <?php 
				
						//query to get studios details which customer has message latest	
						$query2="SELECT DISTINCT studio.studio_id,studio.studio_name,studio.profile FROM studio INNER JOIN  messages ON messages.s_id=studio.studio_id WHERE messages.c_id=$user_id  ORDER BY messages.msg_id DESC ";
						$result_set2=mysqli_query($connection,$query2);
							 if(mysqli_num_rows($result_set2)>0){	//when customer has stated to massage any of studio					
								while($record2=mysqli_fetch_assoc($result_set2)){
									
									$query4="SELECT * FROM messages WHERE c_id=$user_id AND s_id=$record2[studio_id] ORDER BY msg_id DESC LIMIT 1"; //query to get letest msg of perticular studio and customer
									$result_set4=mysqli_query($connection,$query4);
									$record4=mysqli_fetch_assoc($result_set4);
									if($record4['incoming_msg']){ 
										$latest=$record4['incoming_msg'];
									}
									else{
										$latest=$record4['outgoing_msg'];
									}
		
									echo '	
											<a href="cust_chat.php?studio_id='.$record2['studio_id'].'" alt="">
											<div class="content">
											<img src= "../../img/studio/'.$record2['profile'].'"   alt="">
											<div class="details">
											<span>'.$record2['studio_name'].'</span>
											<p>'.$latest.'</p>					
											</div>
											</div>
											<div class="status-dot"><i class="fas fa-circle"> </i></div>
											</a> 
									
									';
		
								}
							}
							else if(mysqli_num_rows($result_set2)==0){
								$query3="SELECT * FROM studio LIMIT 6";  //getting sample studios 
								$result_set3=mysqli_query($connection,$query3);
								if($result_set3){  //when customer has not stated to massage any of studio	
									while($record3=mysqli_fetch_assoc($result_set3)){
										echo '	
												<a href="cust_chat.php?studio_id='.$record3['studio_id'].'" alt="">
												<div class="content">
												<img src= "../../img/studio/'.$record3['profile'].'"   alt="">
												<div class="details">
												<span>'.$record3['studio_name'].'</span>
												<p>This is test massage</p>					
												</div>
												</div>
												<div class="status-dot"><i class="fas fa-circle"> </i></div>
												</a> 
										
										';
			
									}
		
								}
		
							}

								

							
				 
				 ?>


			</div>
		</section>
	</div>
	<!-- <script src="../../assets/inbox.js"></script> -->
	<script>
		function live_search(val_in_textbox) {
		if (val_in_textbox.length==0) {
			document.getElementById("search").innerHTML="";
			return;
		}
		
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
			document.getElementById("search").innerHTML=this.responseText;
			
			}
		}
		xmlhttp.open("GET","../../controller/inbox_search.php?search_text="+val_in_textbox,true);
		xmlhttp.send();
		}
	</script>
	<?php require_once('../../inc/minfooter.php'); ?>
	
</div>
</html>