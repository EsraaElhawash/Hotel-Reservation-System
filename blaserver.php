<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'Hotel3');


if (isset($_POST['yes_conf'])) {

  $room_id=$_SESSION['room_id'];
  
	
  $reservation_id=$_SESSION['reserv_id'];
  

    $t_sql = "UPDATE Reservation SET confirmation=1 WHERE reservation_id='$reservation_id'";
    $t_result = mysqli_query($db,$t_sql); 

    $t_sql = "UPDATE Rooms SET booking=1 WHERE room_id= '$room_id'";
    $t_result = mysqli_query($db,$t_sql); 
    
    $payment=$_SESSION['payment'];
    
    $paybrok= (9*$payment)/100;


  	$query = "INSERT INTO Hotel (should_pay) 
  			  VALUES('$paybrok')";
  	mysqli_query($db, $query);

  header('location: Brokerconf.php');

 }

 if (isset($_POST['no_conf'])) {


	$username=$_SESSION['username'];
  $room_id=$_SESSION['room_id'];

  $query = "SELECT customer_id FROM Customer WHERE username='$username' ";
    $results = mysqli_query($db, $query);
    $user= mysqli_fetch_assoc($results);
     $reservation_id=$_SESSION['reserv_id'];
   
    $t_sql = "UPDATE Rooms SET booking=0 WHERE room_id= '$room_id'";
    $t_result = mysqli_query($db,$t_sql); 

    

  // $query="SELECT DATEADD(day, 10, CURRENT_TIMESTAMP) ";
   // $result  = mysqli_query($db, $query);
    //$user= mysqli_fetch_field($result);
  // $end_date=$user['DateAdd'];

$id = $user['customer_id'];
echo $id;


  $user_check_query = "SELECT * FROM Blacklist WHERE customer_id = '$id'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user['black_id']) { // if user exists
    
    //$t_sql = "UPDATE Blacklisted SET status=1 , start_date=CURRENT_TIMESTAMP, end_date= '$end_date' WHERE customer_id= '$id'";
  
    $t_sql = "UPDATE Blacklisted SET status=1 , start_date=CURRENT_DATE WHERE customer_id= '$id'";
  }

   else {
  	$query = "INSERT INTO Blacklist(customer_id,start_date,status) 
          VALUES('$id',CURRENT_TIMESTAMP ,1)";
    mysqli_query($db, $query);}
  	header('location: default.php');
   
 }


 if (isset($_POST['yes_paid'])) {

	$id=$_SESSION['hotel_id'];

    $t_sql = "UPDATE Hotel SET paid=1 WHERE hotel_id= '$id'";
    $t_result = mysqli_query($db,$t_sql); 
     header('location:default.php');

 }

  if (isset($_POST['no_paid'])) {

	$id=$_SESSION['hotel_id'];

    $t_sql = "UPDATE Hotel SET paid=0 WHERE hotel_id= '$id'";
    $t_result = mysqli_query($db,$t_sql); 
     header('location:default.php');

 }
 ?>