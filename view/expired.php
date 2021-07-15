<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Expired!</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <?php require_once('../inc/navbar.php'); ?>
  <div class=expired>
    <h1>Your Account Membership is Expired !</h1>
    <h3>You Need to Renew the membership.</h3>

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="business" value="recordexonline@gmail.com">
      <input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="item_name" value="Instrument pack">
	  <input type="hidden" name="item_number" value="1255">
	  <input type="hidden" name="amount" value="5.0">
	  <input type='hidden' name='return' value="http://localhost/Rex/view/login.php?everified=Membership Renewed!">	
	  <input type="hidden" name="currency_code" value="USD">
	  <input style="width:100px; border-radius:0; border:none; margin:10px 0; font-family:sans-serif;" id="pay" type="submit" name="pay" value="Pay">
	</form>

    <h4>5.00USD</h4>
    <img src="../img/580b57fcd9996e24bc43c530.png">
  </div>
  <?php require_once('../inc/minfooter.php'); ?>  
</body>
</html>