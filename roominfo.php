<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="header">
	<h2>ENTER ROOM INFORMATION</h2>
</div>
<form action="roominfo.php" method="post" name="myForm">
  <?php include('errors.php'); ?>

 <div class="input-group">
<label>
    <input type="radio" name="Type" value="1" />
    <span class="icon">Single</span>
  </label>
  <label>
    <input type="radio" name="Type" value="2" />
    <span class="icon">Double</span>
  </label>
  <label>
    <input type="radio" name="Type" value="3" />
    <span class="icon">Triple</span>
  </label><br>
  <label>
    <input type="radio" name="fas" value="1" />
    <span class="icon">Sea view</span>
  </label>
  <label>
    <input type="radio" name="fas" value="2" />
    <span class="icon">Pool view</span>
  </label>
  <label>
    <input type="radio" name="fas" value="3" />
    <span class="icon">Garden view</span>
  </label><br>
price:<br>
<input type="text" name="price"> 


<div class="submit">
<button type="submit" class="btn" name="room_reg">Submit</button>
</div>
    	<p> <a href="ownerlogin.php?logout='1'" style="color: red;">logout</a> </p>
      <p> <a href="approve.php?logout='1'" style="color: red;">Done</a> </p>
		
</div>
		
</body>
</html>