<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Owner: Sign in</h2>
  </div>
	 
 <form action="OwnerLogin.php" method="post" name="myForm">
 	<?php include('errors.php'); ?>
 <div class="input-group">
Name:<br>
<input type="text" name="ownername"> 
<br>
Password:<br>
<input type="password" name="password"> 
<br>

<div class="submit">
<button type="submit" class="btn" name="login_owner">Login</button>
</div>
<p>New here? <a href="signupowner.php">sign up here</a>.</p>
</div>
</form>
</body>
</html>