<?php 
require_once('../../inc/connection.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Paypal</title>
	<link rel="stylesheet" type="text/css" href="../../css/customer/paypal.css">
</head>
<body>
	<div class="nav body" style="padding-left: 0;">
		<?php require_once('../../inc/cust_dash_navbar.php');?>
	</div>
	<div class="body">
		<h1>Paypal Sandbox</h1>
		<a href="recipt.php" class="finish" >Finsih</a>
	</div>

	<?php require_once('../../inc/minfooter.php'); ?>
</body>
</html>