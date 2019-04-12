<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>Broker</title>
</head>
<body>
<form action="approve.php" method="post" name="myForm">

 <div class="input-group">
<div class="header">
	<h2>New Hotel Has Registered! Please Approve it or Deny</h2>
</div>
<div class="submit">
<button type="submit" class="btn" name="approve">Approve</button>
</div>
<div class="submit">
<button type="submit" class="btn" name="deny">Deny</button>
</div>
</div>
</body>
</html>
