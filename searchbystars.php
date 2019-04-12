<?php include('search.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Customer you may search by stars :</h2>
  </div>
  <form action="searchbystars.php" method="post" name="myForm">
    <div class="input-group">
      <label>Search over here by stars pleeeaaase !!!!:</label>
      <input type="text" name="search">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="search_customer2">Search</button>
    </div>
 </form>
</body>
</html>