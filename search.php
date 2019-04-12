<?php
session_start();
$name="";
$gigi= array();
$gigi2=array();
    $db = mysqli_connect("localhost", "root", "", "Hotel3");
//search by location.
    if (isset($_POST['search_customer'])) {
    $name = mysqli_real_escape_string($db, $_POST['search']);


    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

$result2= mysqli_query($db, "SELECT * FROM hotel
    WHERE location LIKE '%{$name}%' AND premium = '1' AND approval_status='1'");
if(mysqli_num_rows($result2) > 0 ){
while ($row = mysqli_fetch_array($result2))
{       
    array_push($gigi2,$row['hotel_name']);
  }
    $_SESSION['searchh2'] = $gigi2;
    $_SESSION['success'] = "found this hotel";
  }
else {
      $_SESSION['searchh2'] = 0;

}


$result = mysqli_query($db, "SELECT * FROM hotel
    WHERE location LIKE '%{$name}%' AND premium ='0' AND approval_status='1'");
 
if(mysqli_num_rows($result) > 0 ){
while ($row = mysqli_fetch_array($result))
{ 
  array_push($gigi,$row['hotel_name']);
}
    $_SESSION['searchh'] = $gigi;
    $_SESSION['success'] = "found this hotel";
   


header('location: here.php');
}
echo 'Sorry, We could not find any hotels in this location ';

  }
  //_________________________________________________________________________________________________________

  if (isset($_POST['search_customer2'])) {
    $name = mysqli_real_escape_string($db, $_POST['search']);

    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
$result2= mysqli_query($db, "SELECT * FROM Hotel
    WHERE stars LIKE '%{$name}%' AND premium = '1' AND approval_status='1'");
while ($row = mysqli_fetch_array($result2))
{ 
       array_push($gigi2,$row['hotel_name']);
       
  }     
    $_SESSION['searchh2'] = $gigi2;
    $_SESSION['success'] = "found this hotel";
  


$result = mysqli_query($db, "SELECT * FROM Hotel
    WHERE stars LIKE '%{$name}%' AND premium='0' AND approval_status='1'");
 
while ($row = mysqli_fetch_array($result))
{ 
       array_push($gigi,$row['hotel_name']);
       
       }
    $_SESSION['searchh'] = $gigi;
    $_SESSION['success'] = "found this hotel";
  

if($name> '0' AND $name<= '5')
  {header('location: here.php');}
echo 'Invalid Entry..';
echo '</br>';
echo 'please choose between 1 to 5 stars.';
}
//________________________________________________________________________________________________
//search by price..
 if (isset($_POST['search_customer3'])) {
    $name =mysqli_real_escape_string($db, $_POST['search']);
    $name2 =mysqli_real_escape_string($db, $_POST['search2']);
    echo'you entered a range ';
    echo 'from: ';
echo $name;
echo ' to: ';
echo $name2;
echo '</br>';
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      
      $okay=array();
$result2=mysqli_query($db,"SELECT * FROM rooms WHERE price BETWEEN '$name'  AND  '$name2'");
if(mysqli_num_rows($result2) > 0 ){
while($row1=mysqli_fetch_array($result2)){
  echo 'im in here';
  echo $row1['price'];
  array_push($okay,$row1['hotel_id']);
}
print implode(',',$okay);
$gigi=array();
for ($i = 0; $i < count($okay); $i++) {
$bambo=$okay[$i];
$query2="SELECT * FROM Hotel WHERE hotel_id=$bambo AND premium='1' AND approval_status='1'"; //hotel id of chosen hotel
$result=mysqli_query($db,$query2);

while ($row = mysqli_fetch_array($result))
{      
       echo $row['hotel_name'];
       array_push($gigi2,$row['hotel_name']);

  }

    $_SESSION['searchh2'] = $gigi2;
    $_SESSION['success'] = "found this hotel";
   }
}
$result1=mysqli_query($db,"SELECT * FROM rooms WHERE price BETWEEN '$name'  AND  '$name2' ");
if(mysqli_num_rows($result1) > 0 ){
while($row1=mysqli_fetch_array($result1)){
  echo 'im in here';
  echo $row1['price'];
  array_push($okay,$row1['hotel_id']);
}
print implode(',',$okay);
$gigi=array();
for ($i = 0; $i < count($okay); $i++) {
$bambo=$okay[$i];
$query2="SELECT * FROM Hotel WHERE hotel_id=$bambo AND premium='0' AND approval_status='1'"; //hotel id of chosen hotel
$result=mysqli_query($db,$query2);

while ($row = mysqli_fetch_array($result))
{      
       echo $row['hotel_name'];
       array_push($gigi,$row['hotel_name']);

  }

    $_SESSION['searchh'] = $gigi;
    $_SESSION['success'] = "found this hotel";
   
}
echo 'im printing gigi';
print implode(',', $gigi);

echo '</br>';
echo 'im out of all loops';
print implode(',', $gigi);

header('location: here.php');
}
echo 'Sorry we could not find any Hotels in that price range';
}
//_____________________________________________________________________
//search by room type.
   if (isset($_POST['search_customer4'])) {
    $name =mysqli_real_escape_string($db, $_POST['search']);
    //echo 'print yabni';
    echo 'you entered "';
echo $name;
echo '"';

 if($name=="Single" or $name=="single")
          { 
            echo '</br>';
            echo ' first if';
            $name='1';
            echo $name;
          }
         if ($name=="Double" or $name=="double")
          { 
            echo '</br>';
            echo ' second if';
            $name='2';
            echo $name;
          }
          if ($name=="Triple" or $name=="triple")
          {
            echo '</br>';
            echo 'third if';
            $name='3';
          }

     if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
  
      $okay=array();
$result2=mysqli_query($db,"SELECT * FROM rooms WHERE roomtype_id LIKE '$name'");
while($row1=mysqli_fetch_array($result2)){
  echo 'im in here';
  echo $row1['roomtype_id'];
  array_push($okay,$row1['hotel_id']);
}
print implode(',',$okay);
$gigi=array();
for ($i = 0; $i < count($okay); $i++) {
$bambo=$okay[$i];
$query2="SELECT * FROM Hotel WHERE hotel_id=$bambo AND premium='1' AND approval_status='1'"; //hotel id of chosen hotel
$result=mysqli_query($db,$query2);

while ($row = mysqli_fetch_array($result))
{      
       echo $row['hotel_name'];
       array_push($gigi2,$row['hotel_name']);

  }

    $_SESSION['searchh2'] = $gigi2;
    $_SESSION['success'] = "found this hotel";
   
}
$result1=mysqli_query($db,"SELECT * FROM rooms WHERE roomtype_id LIKE '$name'");
while($row1=mysqli_fetch_array($result1)){
  echo 'im in here';
  echo $row1['roomtype_id'];
  array_push($okay,$row1['hotel_id']);
}

print implode(',',$okay);
$gigi=array();
for ($i = 0; $i < count($okay); $i++) {
$bambo=$okay[$i];
$query2="SELECT * FROM Hotel WHERE hotel_id=$bambo AND premium='0' AND approval_status='1'"; //hotel id of chosen hotel
$result=mysqli_query($db,$query2);


while ($row = mysqli_fetch_array($result))
{      
       echo $row['hotel_name'];
       array_push($gigi,$row['hotel_name']);

  }

    $_SESSION['searchh'] = $gigi;
    $_SESSION['success'] = "found this hotel";
   
}


echo '</br>';


if($name=='1' or $name=='2' or $name==3)
{
header('location: here.php');
}
echo 'invalid choide.';
echo '</br>';
echo 'please Enter either Single , Double or Triple';
}
    mysqli_close($db);
    ?>