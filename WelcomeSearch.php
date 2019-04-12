<?php include('clock.php') ?>
<?php include('customerserver.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>

  <div class="header">
  	<h2>Welcome <?php $myname=$_SESSION['username']; echo $myname;?> you may search  :</h2>
  </div>
  <form action="WelcomeSearch.php" method="post" name="myForm"> 
</div>
<p>Search by <a href="searchbylocation.php"style= "color: red"> Location</a></p>
<p>Search by <a href="searchbystars.php"style= "color: yellow"> Stars</a></p>
<p>Search by <a href="searchbyprice.php"style= "color: red"> Price</a></p>
<p>Search by <a href="searchbyroomtype.php"style= "color: yellow"> Room Type</a></p>
</div>
<div class="submit">
	<button type="submit" class="btn" name="history"> Check reservations </button>
</div>
</form>
</body>
</html>
