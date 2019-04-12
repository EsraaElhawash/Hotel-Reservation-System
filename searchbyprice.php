<?php include('search.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Customer you may search by price :</h2>
  </div>
  <form action="searchbyprice.php" method="post" name="myForm">
    <div class="input-group">
      <label>Cost Ranging from :</label>
      <input type="text" name="search">
    </div>
     <div class="input-group">
      <label>To:</label>
      <input type="text" name="search2">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="search_customer3">Search</button>
    </div>
 </form>
</body>
</html>