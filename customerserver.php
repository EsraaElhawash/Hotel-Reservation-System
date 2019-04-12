<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'Hotel3');


if (isset($_POST['reg_customer'])) {
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
  $user_check_query = "SELECT * FROM Customer WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  //  $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO customer (username, email, password) 
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    
    header('location: LoginCustomer.php');
  }
}
  // Finally, register user if there are no errors in the form
  

if (isset($_POST['login_customer'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $_SESSION['username']=$username;

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	//$password = md5($password);
  	$query = "SELECT * FROM Customer WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    $user= mysqli_fetch_assoc($results);

    


    $t_sql = "UPDATE Customer SET last_login=CURRENT_TIMESTAMP WHERE username = '$username'";
     $t_result = mysqli_query($db,$t_sql); 
  	if (mysqli_num_rows($results) == 1) {
  	  
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: WelcomeSearch.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['history'])){
header('location:info.php');
 $username=$_SESSION['username'];

$q1="SELECT customer_id FROM Customer WHERE username='$username'";
$r1= mysqli_query($db,$q1);
$u1= mysqli_fetch_assoc($r1);
$currentcustomer=$u1['customer_id'];


$g2=array();
$g3=array();
$g4=array();
$g5=array();
$q2="SELECT * FROM Reservation WHERE customer_id='$currentcustomer'";
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

if (isset($_POST['cust_book'])){

   $timeLimit = 1; //seconds  
echo 'fml';
 $start = date("Y-m-d H:i:s",time());
 $end = date("Y-m-d H:i:s",time()+$timeLimit);

 function getSecDifference($to,$from)
{

    $date1 = new DateTime($to);
    $date2 = new DateTime($from);
    $interval = $date1->diff($date2);

    return number_format($interval->s,0,'','');

}

 for($x=0;$x<=$timeLimit;$x++){
    $next = date("Y-m-d H:i:s",time());
    $dif = getSecDifference($end,$next);            
  
      if($dif > 0)
       { $x--; }
    else{
       // header('location: booked.php');              
    }
}


 $type = mysqli_real_escape_string($db, $_POST['Type']);
 $checkin = mysqli_real_escape_string($db, $_POST['datein']);
 $checkout = mysqli_real_escape_string($db, $_POST['dateout']);

 $username=$_SESSION['username'];

$hotelName = $_SESSION['hotelName'];


 $query = "SELECT hotel_id FROM Hotel WHERE hotel_name='$hotelName'";
 $result = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($result);
 $hotel_id = $user['hotel_id'];



 $query = "SELECT customer_id FROM Customer WHERE username='$username'";
 $result = mysqli_query($db, $query);
 $user= mysqli_fetch_assoc($result);
 $cust_id = $user['customer_id'];



  $query = "SELECT room_id FROM Rooms WHERE hotel_id='$hotel_id'AND roomtype_id='$type' AND booking = 0 ";
 //$room_id = mysqli_query($db, $query);
  $result  = mysqli_query($db, $query);
  $user= mysqli_fetch_assoc($result);
  $first_value = $user['room_id'];
 //$first_value = reset($room_id); 



 $query = "INSERT INTO Reservation(customer_id,room_id, check_in,check_out,reserve_date) 
          VALUES('$cust_id','$first_value', '$checkin', '$checkout',CURRENT_TIMESTAMP)";   
        
    mysqli_query($db, $query);


   



 $query = "SELECT reservation_id FROM Reservation WHERE room_id='$first_value' AND customer_id='$cust_id'";
$result5 = mysqli_query($db, $query);
 $final=mysqli_fetch_assoc($result5);
 $reservID=$final['reservation_id'];

 $_SESSION['reserv_id']=$reservID;
 echo '</br>';




 //$days2= date_diff($checkin,$checkout);
 $days=(strtotime($checkout) - strtotime($checkin));
 $query="SELECT * FROM rooms WHERE room_id='$first_value'";
 $result  = mysqli_query($db, $query);
  
  while($row = mysqli_fetch_assoc($result)){
    $rate = $row['price']; 
  }  
  
  $datediff=(strtotime($checkout) - strtotime($checkin));
  $dayspayable= round($datediff / (60 * 60 * 24));
$payable= $rate*$dayspayable;
  echo $payable;
  echo $rate;
  echo $dayspayable;
  $query = "UPDATE reservation SET total_payment=$payable WHERE reservation_id='$reservID'";
         
 $result = mysqli_query($db, $query);
  $_SESSION['payment']=$payable;
  


$t_sql = "UPDATE Reservation SET reserve_date=CURRENT_TIMESTAMP WHERE reservation_id='$reservID'";
     $t_result = mysqli_query($db,$t_sql);



  $query2= "INSERT INTO Reserv_room(reservation_id,room_id) VALUES ('$reservID','$first_value')";
    
    mysqli_query($db, $query2);
 
 $query3= "INSERT INTO Reserv_customer(reservation_id,customer_id) VALUES ('$reservID','$cust_id')";

    mysqli_query($db, $query3);

   

     header('location: ownerconf.php');

}


?>