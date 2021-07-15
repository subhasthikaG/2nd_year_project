<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

       *{
         padding: 0;
         margin: 0;
         text-decoration: none; 
         list-style: none;
         box-sizing: border-box;
      }
  
      nav{
         background-color: white;
         height: 40px;
         width: 100%;
         position: fixed;
         overflow: hidden;
         z-index: 1; 
      }

      nav ul{
         float: right;
         margin-right: 20px; 
         list-style: none;
      }      

      nav ul li{
         display: inline-block;
         line-height: 40px;
         margin: 0 5px; 
      }

      nav ul li a{
         font-family: sans-serif;
         color: black;
         font-size: 15px;
         padding: 12px 13px;
         text-transform: uppercase;
         font-weight: bold; 
      }

      #user{
         font-size:1.4em; 
       }

      nav ul li a:hover{
         background: #9c9595;
         color: white;
         transition: 0.5s; 
      }

      nav a.logo{
         line-height: 40px;
         padding-left:15px;
      }

      nav a.logo img{
         height: 40px; 
      }

      a.active{
      background-color: rgb(56,57,68);
      color: white;
    }
    </style>
</head>
<?php
$user_name="User";
 if(isset($_SESSION['username']) && isset($_SESSION['user_id'])){
      $user_name=$_SESSION['username'];//store logged customer username and c_id
      $user_id=$_SESSION['user_id'];

      $query="SELECT * FROM studio WHERE studio_id = $user_id";
      $result_set = mysqli_query($connection,$query);

      if($result_set){
        $record =mysqli_fetch_assoc($result_set);
        $user_name=$record['studio_name'];
        $user_id=$record['studio_id'];
        $SESSION['user_id']=$user_id;
      }
   }
?>

<nav>
  <a class="logo" href="#"><img src="../../inc/logo3.png"></a>
  <ul>
  <?php $filename=basename($_SERVER['PHP_SELF'])?>
    <li><a href="../studio/studio_dash.php" <?php if($filename=='studio_dash.php')  echo "class=active"?>><i class="fa fa-fw fa-columns"></i> Dashboard</a></li>
    <li><a href="../studio/studio_schedule.php" <?php if($filename=='studio_schedule.php') echo "class=active"?>><i class="fa fa-clock-o"></i> Schedule</a></li>
    <li><a href="../../view/studio/cust_request.php" <?php if($filename=='cust_request.php' || $filename=='cust_request_view.php') echo "class=active"?>><i class="fa fa-fw fa-briefcase"></i> Jobs</a></li>
    <li><a href="../../view/studio/studio_inbox.php" <?php if($filename=='studio_inbox.php') echo "class=active"?>><i class="fa fa-fw fa-envelope-open"></i> Inbox</a></li>
    <li><a href="../../controller/logout.php"><i class="fa fa-fw fa-lightbulb-o"></i> Logout</a></li>
    <li><a style='font-size:10px;' id="user" title="<?php echo $user_name;?>" href="../studio/studio_profile.php" <?php if($filename=='studio_profile.php') echo "class=active"?>><i style='font-size:20px;' class="fa fa-fw fa-user-circle"></i><?php echo $user_name;?></a></li>
  </ul>  
</nav>