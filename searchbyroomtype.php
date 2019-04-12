<?php include('search.php') ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="header">
  	<h2>Welcome Customer you may search by Room Type:</h2>
  </div>
  <form action="searchbyroomtype.php" method="post" name="myForm">
    <div class="input-group">
      <label>Search over here by Room Type.!:</label>
      <input type="text" name="search">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="search_customer4">Search</button>
    </div>
 </form>
</body>
</html>