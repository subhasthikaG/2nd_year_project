<meta charset="utf-8">
	<title>Inbox</title>
	<link rel="stylesheet"  href="../../css/inbox.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<div class="overlay">
    <div class="users-list">
        <?php 
            require_once('../inc/connection.php');
            session_start();       
            
                
            $keyword=$_GET["search_text"];        
            if($keyword!="")
            {
                $sql_select = "SELECT * FROM studio WHERE studio_name LIKE '%$keyword%'";
                $result_set = mysqli_query($connection,$sql_select);
                if(mysqli_num_rows($result_set)>0)
                {
                    while($record = mysqli_fetch_assoc($result_set)){
                        echo '
                    
                                
                                        <a href="cust_chat.php?studio_id='.$record['studio_id'].'" alt="">
                                        <div class="content">
                                        <img src= "../../img/studio/'.$record['profile'].'"   alt="">
                                        <div class="details">
                                        <span>'.$record['studio_name'].'</span>
                                        <p>Hey there! Can I help you</p>					
                                        </div>
                                        </div>
                                        <div class="status-dot"><i class="fas fa-circle"> </i></div>
                                        </a> 
                                    
                        

                        ';                    
                    }
                }	  
                else
                {
                    echo '<h2>No such a studio found</h2>';
                }
            }  
            
    
        
        ?>
    </div> 

</div>


