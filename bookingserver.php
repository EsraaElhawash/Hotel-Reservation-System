<?php
session_start();

$type = "";
$checkin    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'Hotel3');


if (isset($_POST['cust_book'])){

	

 $type = mysqli_real_escape_string($db, $_POST['Type']);
 $checkin = mysqli_real_escape_string($db, $_POST['datein']);
 $checkout = mysqli_real_escape_string($db, $_POST['dateout']);
 $username=$_SESSION['ownername'];

 $hotelname=$_SESSION['hotelname'];
 $query = "SELECT hotel_id FROM hotel WHERE Hotel_name='$hotelname";
 $hotel_id = mysqli_query($db, $query);

 $query = "SELECT customer_id FROM customer WHERE username='$username'";
 $cust_id = mysqli_query($db, $query);

$query = "SELECT room_id FROM room WHERE hotel_id='$hotel_id'AND Roomtyp_id='$type' AND Booking = 0 ";
 $room_id = mysqli_query($db, $query);

 $first_value = reset($room_id); 


 $query = "INSERT INTO reservation (customer_id,room_id,hotel_id, check_in,check_out,reserv_date) 
          VALUES('$cust_id','$first_value','$hotel_id', '$checkin', '$checkout',CURRENT_TIMESTAMP)";   
        
    mysqli_query($db, $query);

 $query = "SELECT reservationid FROM reservation WHERE room_id='$first_value";
 $reservID = mysqli_query($db, $query);

  $query = "INSERT INTO reserv_room(reservationid , room_id)
  VALUES ('$reservID','$first_value')";

    mysqli_query($db, $query);

 $query = "INSERT INTO reserv_customer(reservationid , customer_ID)
  VALUES ('$reservID','$cust_id')";

    mysqli_query($db, $query);

     header('location: WelcomeSearch.php');

} ?>