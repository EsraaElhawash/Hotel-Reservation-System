<?php include('search.php') ?>
<?php include('clock.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Customer you may search by location :</h2>
  </div>
  <form action="searchbylocation.php" method="post" name="myForm">
    <div class="input-group">
      <label>Search over here by location pleeeaaase:</label>
      <input type="text" name="search">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="search_customer">Search</button>
    </div>
 </form>
</body>
</html>