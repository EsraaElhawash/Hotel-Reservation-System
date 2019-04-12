<?php include('ownerserver.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>Broker</title>
</head>
<body>
<form action="info.php" method="post" name="myForm">

 <div class="input-group">
<div class="header">
    <h2>checkins and checkouts</h2>
</div>
<?php 
echo '</br>';
echo 'Name: ';
echo $_SESSION['username'];
echo '</br>';
$g2=array();
$g3=array();
$g4=array();
$g5=array();
$g2=$_SESSION['roomarray'];
$g3=$_SESSION['checkinarray'];
$g4=$_SESSION['checkoutarray'];
$g5=$_SESSION['datesarray'];
for($i=0;$i<count($g2);$i++)
{ 
  $q3="SELECT hotel_id FROM Rooms WHERE room_id='$g2[$i]'";
  $r3=mysqli_query($db,$q3);
  $u3=mysqli_fetch_assoc($r3);
  $currenthotel=$u3['hotel_id'];
  
  $q4="SELECT hotel_name FROM Hotel WHERE hotel_id='$currenthotel'";
  $r4=mysqli_query($db,$q4);
  $u4=mysqli_fetch_assoc($r4);
  $currenthotelname=$u4['hotel_name'];
  
 echo 'you booked room: ';
  echo $g2[$i];
  echo ' ';
  echo 'in Hotel: ';
  echo $currenthotelname;
  echo ' ';
  echo 'on date: ';
  echo $g5[$i];
  echo ' ';
  echo 'from: ';
  echo $g3[$i];
  echo ' ';
  echo 'to: ';
  echo $g4[$i];
  echo '</br>';
  echo '</br>';




}

?>
<p><a href="hotelinfo.php"style= "color: black"> Back</a></p>

</div>


</body>
</html>

