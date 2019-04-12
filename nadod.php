<?php include('customerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Here are all the information for the hotel you chose!</h2>
  </div>
  <?php
  
    $db = mysqli_connect("localhost", "root", "", "Hotel3");

	  if(isset($_GET["data"])){

      $hotelName=$_GET["data"];

            echo 'you chose ';
      echo  $_GET["data"] ;
      echo ' hotel .';
$query1="SELECT * FROM Hotel WHERE hotel_name='$hotelName'";
$hope=mysqli_query($db,$query1);
$user=mysqli_fetch_assoc($hope);
if($user)
{   echo "</br>";
	echo "this hotel has : " ;
	echo $user['stars'];
	echo " stars";
	echo "</br>";
	echo  "this hotel is located in: ";
	echo $user['location'];
	echo "</br>";
}
 $_SESSION['hotelName']=$hotelName;
$query2="SELECT hotel_id FROM Hotel WHERE hotel_name='$hotelName'";
$input=mysqli_query($db,$query2);
$user2=mysqli_fetch_assoc($input);
$eh=$user2['hotel_id'];

$query3="SELECT * FROM rooms WHERE hotel_id='$eh'";
$input2=mysqli_query($db,$query3);
//$user3=mysqli_fetch_assoc($input2);


//if($user3){
//	echo 'the rating of this hotel is ';
	//echo $user3['RoomRateID'];
//}

  }
?>
<p>Please choose your room</p>
<form action="nadod.php" method="post" name="myForm">
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
  </label><br><br>
  <label>
    <input type="radio" name="fes" value="1" />
    <span class="icon">Sea view</span>
  </label>
  <label>
    <input type="radio" name="fes" value="2" />
    <span class="icon">Garden view</span>
  </label>
  <label>
    <input type="radio" name="fes" value="3" />
    <span class="icon">Pool view</span>
  </label><br><br>
  <p>Check in Date</p>
  <input type="date" name="datein" id="dateinput" > <br><br>
  <p>Check out Date</p>
   <input type="date" name="dateout" id="dateinput" > <br>

  <div class="submit">
<button type="submit" class="btn" name="cust_book">Book noww!</button>
</div>
<p> <a href="default.php?logout='1'" style="color: black;">home page</a> </p>

</form>
</body>
</html>
