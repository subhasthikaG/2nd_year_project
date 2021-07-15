<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">
    *{
      padding: 0;
      margin: 0;
      text-decoration: none;
      list-style: none;
      box-sizing: border-box;
    }

    header{
      font-family: sans-serif;
    }

    nav{
      background-color: white;
      height: 40px;
      width: 100%;
      position:fixed;
      overflow: hidden;
      z-index:1;
    }

    nav ul{
      float: right;
      margin-right: 20px;
    }

    nav ul li{
      display: inline-block;
      line-height: 40px;
      margin: 0 5px;
    }

    nav ul li a{
      font-family: sans-serif;
      color:black;
      font-size: 15px;
      padding: 12px 13px;
      text-transform: uppercase;
      font-weight: bold;
    }

    nav ul li a:hover{
      background: #9c9595;
      color:white;
      transition: 0.5s;
    }

    a.logo{
      line-height: 40px;
      padding-left: 15px;
    }

    a.logo img{
      height: 40px;
    }

	a.active{
      background-color: #3459e2;
      color: white;
    }
 
    </style>
  </head>

    <nav>
      <a class="logo" href="../view/home.php"><img src="../../../REX/inc/logo3.png"></a>
      <ul>
	    <?php $filename=basename($_SERVER['PHP_SELF'])?>
        <li><a href="../../../REX/view/home.php" <?php if($filename=='home.php') echo "class=active"?>><i class="fa fa-fw fa-home"></i> Home</a></li>
        <li><a href="../../../REX/view/about.php" <?php if($filename=='about.php') echo "class=active"?>><i class="fa fa-fw fa-address-card"></i> About Us</a></li>
        <li><a href="../../../REX/view/sign_up.php" <?php if($filename=='sign_up.php' || $filename=='cust_reg.php' || $filename=='owner_existence.php' || $filename=='owner_existform.php' ||  $filename=='studio_reg_1.php' || $filename=='studio_reg_2.php') echo "class=active"?>><i class="fa fa-fw fa-user-plus"></i> SignUp</a></li>
        <li><a href="../../../REX/view/login.php" <?php if($filename=='login.php') echo "class=active"?>><i class="fa fa-fw fa-user"></i> Login</a></li>
        <li><a href="../../../REX/view/FAQ.php" <?php if($filename=='FAQ.php') echo "class=active"?>><i class="fa fa-fw fa-info-circle"></i> FAQ</a></li>
      </ul>
    </nav>
