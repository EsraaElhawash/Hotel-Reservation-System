<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<html>
  <head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>welcome</title>
</head>
<body>
<div class="header">
	<h2>ENTER HOTEL INFORMATION</h2>
</div>
<form action="hotelinfo.php" method="post" name="myForm">
<?php include('errors.php'); ?>
 <div class="input-group">
Hotel Name:<br>
<input type="text" name="name"> 
<br>
location:<br>
<input type="text" name="location"> 
<br>
 <input type="checkbox" name="premium" value="1"> Premium<br>
<div class="rating">
stars
  <label>
    <input type="radio" name="stars" value="1" />
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="2" />
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="3" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>   
  </label>
  <label>
    <input type="radio" name="stars" value="4" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="5" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>

</div>
<br>
<div class="submit">
<button type="submit" class="btn" name="hotel_reg">Next</button>

</div>   
<div class="submit">
<button type="submit" class="btn" name="reserv">Reservations</button>
</div>
  <p>Select Date For Check in/out</p>
   <input type="date" name="date" id="dateinput" > <br>
<div class="submit">
<button type="submit" class="btn" name="check">Check in/out</button>
</div>
<p> <a href="ownerlogin.php?logout='1'" style="color: red;">logout</a> </p>
</div>
</body>
</html>