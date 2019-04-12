<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<!DOCTYPE html>
<html>

<head>
  <head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>
  
</head>
<body>
  <div class="header">
  	<h2>Sign up Now!</h2>
  </div>
	
 <form action="signupowner.php" method="post" name="myForm">
 	<?php include('errors.php'); ?>
 <div class="input-group">
Name:<br>
<input type="text" name="username" value="<?php  $username; ?>"> 
<br>
Email:<br>
<input type="text" name="email" value="<?php  $email; ?>">
<br>
Password:<br>
<input type="password" name="password"> 
<br>

<div class="submit">
<button type="submit" class="btn" name="reg_owner">Submit</button>
</div>
<p>Already have an account? <a href="ownerlogin.php">Login here</a>.</p>
</div>
</form>
</body>
</html>