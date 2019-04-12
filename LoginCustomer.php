<?php include('customerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Custumer: Sign in and book your hotel now!</h2>
  </div>
	 
 <form action="LoginCustomer.php" method="post" name="myForm">
  <?php include('errors.php'); ?>
 	 	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_customer">Login</button>
  	</div>
 <p>
 	New here? <a href="signupcustomer.php">sign up here</a>
 </p>
</form>
</body>
</html>