<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'Hotel3');


if (isset($_POST['reg_owner'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
 

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
 
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM owners WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);


  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username Already Exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email Already Exists");
    }
  }

  // Finally, register user if there are no errors in the form

  //	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO owners (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	
  	header('location: ownerlogin.php');
  
}

if (isset($_POST['login_owner'])) {
  $username = mysqli_real_escape_string($db, $_POST['ownername']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  //$vari=$_POST['username'];
      $_SESSION['ownername'] = $username;
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

    $query = "SELECT owner_id FROM owners WHERE username='$username' ";
    $results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
    
    $owner_id=$user['owner_id'];

    $query = "SELECT hotel_id FROM hotel WHERE owner_id='$owner_id' AND paid=0 ";
    $results = mysqli_query($db, $query);
    $balah = mysqli_fetch_assoc($results);
     


    
   if ($balah)
   {

    $id=$balah['hotel_id'];
    $_SESSION['idhotel']=$id;

     header('location: ownerapproval.php');  }

  if (count($errors) == 0) {
  	//$password = md5($password);

  	$query = "SELECT * FROM owners WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    


     $t_sql = "UPDATE owners SET last_login=CURRENT_TIMESTAMP WHERE username = '$username'";
     $t_result = mysqli_query($db,$t_sql);

       

  	if (mysqli_num_rows($results) == 1) {
  	  
  	 header('location: hotelinfo.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  } } 

    





if (isset($_POST['hotel_reg'])) {
  // receive all input values from the form
  $hotelname = mysqli_real_escape_string($db, $_POST['name']);
  $location = mysqli_real_escape_string($db, $_POST['location']);
  $stars = mysqli_real_escape_string($db, $_POST['stars']);
  $premium = mysqli_real_escape_string($db, $_POST['premium']);
 // $nada = mysqli_real_escape_string($db, $_POST['username']);
  //echo 'fml';
  //echo $nada;
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($hotelname)) { array_push($errors, "Hotelname is required"); }
  if (empty($location)) { array_push($errors, "Location is required"); }

  $user_check_query = "SELECT * FROM Hotel WHERE hotel_name='$hotelname' ";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);


  if ($user) { // if user exists
    if ($user['hotel_name'] === $hotelname) {
      array_push($errors, "Hotel Name Already Exists");
    }

   
  }
  

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
   $username= $_SESSION['ownername'];
   $_SESSION['hotelname']=$hotelname;

    $user_check_query = "SELECT owner_id FROM owners WHERE username='$username' ";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $ff=$user['owner_id'];

    $query = "INSERT INTO Hotel (owner_id,hotel_name, location, stars ,premium,paid) 
          VALUES('$ff','$hotelname', '$location', '$stars','$premium',1)";
        
        
    mysqli_query($db, $query);

    
  
  }
  $user_check_query = "SELECT hotel_id FROM hotel WHERE hotel_name='$hotelname' ";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $hotel_id=$user['hotel_id'];
  $_SESSION['hotel_id'] = $hotel_id;

    header('location: roominfo.php');

}

if (isset($_POST['approve'])) {

  
  $hotel_id=$_SESSION['hotel_id'] ;
    if (count($errors) == 0) {

    $query = "UPDATE Hotel SET approval_status='1'  WHERE hotel_id='$hotel_id'";
      
    mysqli_query($db, $query);
    header('location: ownerlogin.php');
  }
}

if (isset($_POST['deny'])) {
  $hotel_id=$_SESSION['hotel_id'] ;
    if (count($errors) == 0) {

    $query = "UPDATE Hotel SET approval_status='0' WHERE hotel_id='$hotel_id'";
      
    mysqli_query($db, $query);
    header('location: ownerlogin.php');
  }
}

if (isset($_POST['reserv'])) {
  $hotel_id=$_SESSION['hotel_id'];
    if (count($errors) == 0) {

    $query = "SELECT room_id FROM room WHERE hotel_id='$hotel_id'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
      
    $query = "SELECT reservationID FROM Reserv_room WHERE room_id='$user'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    $_POST['user']=$user;
      
    mysqli_query($db, $query);
    header('location: oldreservation.php');
  }
}
/////////////////////////////////////////////////
if (isset($_POST['check'])) {
  
   $input = mysqli_real_escape_string($db, $_POST['date']);

    if (count($errors) == 0) {


    $query = "SELECT customer_id FROM reservation WHERE check_out='$input'";
      
    $in1=mysqli_query($db, $query);
    if(mysqli_num_rows($in1) > 0 ){
    $in2=mysqli_fetch_assoc($in1);
    $comp=$in2['customer_id'];

    $query2 = "SELECT username FROM customer WHERE customer_id='$comp'";
    $in3=mysqli_query($db, $query2);
    $in4=mysqli_fetch_assoc($in3);
    $comp2=$in4['username'];
echo 'Customer: ';
echo $comp2;
echo ' is checking out on that day';
}
   // header('location: tempinfo.php');

 $query = "SELECT customer_id FROM reservation WHERE check_in='$input'";
      
    $in1=mysqli_query($db, $query);
    if(mysqli_num_rows($in1) > 0 ){
    $in2=mysqli_fetch_assoc($in1);
    $comp=$in2['customer_id'];

    $query2 = "SELECT username FROM customer WHERE customer_id='$comp'";
    $in3=mysqli_query($db, $query2);
    $in4=mysqli_fetch_assoc($in3);
    $comp2=$in4['username'];
echo 'Customer: ';
echo $comp2;
echo ' is checking in on that day';
}
  }
}
if (isset($_POST['room_reg'])) {
  // receive all input values from the form
  $hotel_id=$_SESSION['hotel_id'] ;
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $value = mysqli_real_escape_string($db, $_POST['Type']);
  $fas = mysqli_real_escape_string($db, $_POST['fas']);

 

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  
  if (empty($price)) { array_push($errors, "price is required"); }
  if (empty($value)) { array_push($errors, "Type is required"); }
  if (empty($fas)) { array_push($errors, "Fasility is required"); }


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $query = "INSERT INTO Rooms(hotel_id, roomtype_id, price,booking,fasility) 
          VALUES('$hotel_id', '$value','$price',0,'$fas')";
        
        
    mysqli_query($db, $query);
    
    $_SESSION['success'] = "You are now logged in";
    header('location: roominfo.php');
  }
}
if (isset($_POST['owner_pay'])) {

     $id=$_SESSION['idhotel'];
      
     $t_sql = "UPDATE Hotel SET paid=1 WHERE hotel_id='$id'";
     $t_result = mysqli_query($db,$t_sql); 
     header('location: hotelinfo.php');
 
}
if (isset($_POST['owner_nopay'])){

header('location: default.php');

}
if (isset($_POST['reserv'])){

header('location:infoowner.php');
 $username= $_SESSION['ownername'];

$q1="SELECT owner_id FROM owners WHERE username='$username'";
$r1= mysqli_query($db,$q1);
$u1= mysqli_fetch_assoc($r1);
$owner=$u1['owner_id'];

$q1="SELECT hotel_id FROM Hotel WHERE owner_id='$owner'";
$r1= mysqli_query($db,$q1);
$u1= mysqli_fetch_assoc($r1);
$id=$u1['hotel_id'];


$q1="SELECT room_id FROM Rooms WHERE hotel_id='$id'";
$r1= mysqli_query($db,$q1);
$u1= mysqli_fetch_assoc($r1);
$room=$u1['room_id'];

$g2=array();
$g3=array();
$g4=array();
$g5=array();
$q2="SELECT * FROM Reservation WHERE room_id='$room'";
$r2= mysqli_query($db,$q2);

while($row= mysqli_fetch_array($r2))
{
  array_push($g2,$row['room_id']);
  array_push($g5,$row['reserve_date']);
  array_push($g3,$row['check_in']);
  array_push($g4,$row['check_out']);
}


$_SESSION['username']=$username;
$_SESSION['roomarray']=$g2;
$_SESSION['datesarray']=$g5;
$_SESSION['checkinarray']=$g3;
$_SESSION['checkoutarray']=$g4;

}

?>