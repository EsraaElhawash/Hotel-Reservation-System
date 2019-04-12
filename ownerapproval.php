<?php include('customerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>Owner</title>
</head>
<body>
<form action="ownerapproval.php" method="post" name="myForm">

 <div class="input-group">
<div class="header">
	<h2>You Owe The Broker Money</h2>
</div>
<div class="submit">
<button type="submit" class="btn" name="owner_pay">Going to pay</button>
</div>
<div class="submit">
<button type="submit" class="btn" name="owner_nopay">Won't pay</button>
</div>
</div>
</body>
</html>
