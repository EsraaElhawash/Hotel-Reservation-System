  <?php 
  session_start(); 

  if (!isset($_SESSION['searchh'])) {
    $_SESSION['msg'] = "You must search first";
    header('location: here.php');
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="header">
  <h2>Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['searchh'])) : ?>

      <p>We found the following hotels <strong>
        <?php 
            $arr3=array();
        if($_SESSION['searchh2']){
          $arr1=array();
        $arr2=array();
    
        $arr1=$_SESSION['searchh2']; //array with all found hotels.
        $x=count($arr1);
//print implode(',', $arr1);
        //$x=2;
        $arr2 = array_slice($arr1, 0, $x, true);
        $arr1 = array_diff_assoc($arr1, $arr2);
        $y=count($arr2);
        //$arr3= array_slice($arr2,0,$y,true);
        //$arr2 = array_diff_assoc($arr2, $arr3);
        $farr=array();
        $farr=$arr2;
        $farr=array_unique($farr);
       // print implode(',', $farr);
        foreach($farr as $k => $v) {
    //echo $v;
    echo "  ";
    echo '<a href="nadod.php?data=' . $v . '"' . $k . '">' . $v . '</a>'; 
}
 
}
        
        if($_SESSION['searchh']){
        $arr1=array();
        $arr2=array();
        $arr1=$_SESSION['searchh']; //array with all found hotels.
        $x=count($arr1);
        $arr2 = array_slice($arr1, 0, $x, true);
        $arr1 = array_diff_assoc($arr1, $arr2);
        //$finalarray=array();
      // $finalarray=array_merge($arr2,$arr3);
        $uniarr=array();
        $uniarr=array_unique($arr2);
  foreach($uniarr as $k => $v) {
    //echo $v;
    echo "  ";
    echo '<a href="nadod.php?data=' . $v . '"' . $k . '">' . $v . '</a>'; 
}
}
        ?>
        

      
    <?php endif ?>
</div>
    
</body>
</html>
