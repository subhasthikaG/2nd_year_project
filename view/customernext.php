<html>
  <head>
    <title> </title>
    <style>
      body{
        background-image:linear-gradient(rgba(255,255,255,0.7),rgba(69, 109, 215,0.7)), url('../img/studio-mic.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .textbox{
        padding-top: 15%;
        text-align: center;
        font-family: cursive;
        font-size: 30px;
        color: white;
        padding-bottom: 5%;
      }

      .invalid{
        color: red;
      }

      .button-container{
        padding-left: 45%;   
      }

      .button {
        background-color: #1AB2E7;
        border: none;
        color: white;
        padding: 2% 2%;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-family: sans-serif;
        font-size: 100%;
        margin: 4px 2px;
        cursor: pointer;
      } 
    </style>
  </head>

  <body>
    <?php require_once('../inc/navbar.php');?>
    <div class="textbox"><h1>We have sent you an Email.<br>Please Verify Your Email Address.</h1></div>
    <div class="button-container">
		  <a href="home.php" class="button">Back to Home</a>
	  </div> 
  </body>      
</html>