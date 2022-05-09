<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');
include 'reusables/Header.php';

if(isset($_GET['category']) &&
 ($_GET['category'] == 'UPPERWEAR' || $_GET['category'] == 'BOTTOMS' || $_GET['category'] == 'SHOES' || $_GET['category'] == 'ACCESSORIES'))
  $query = "SELECT * FROM ".$_GET['category'];
else{
  $query = "SELECT * FROM upperwear
    UNION SELECT * FROM bottoms
    UNION SELECT * FROM shoes 
    UNION SELECT * FROM accessories
    ORDER BY RAND()";
}

$database = connectToDatabase();
$result = queryDatabase($database, $query);
disconnectFromDatabase($database);

?>


<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" type="text/css" href="styles/Edit.css">
  <title>Malbasy - Results</title>
</head>

<body>

  <?php if(isset($_SESSION['admin'])){ ?>
  <div class="admin-title">
    <h1>Administrator View</h1>
    <h2>Product Modification</h2>

    <div class="sort-buttons">
      <form action="Edit.php">
        <div class="buttons">
          <input class="category" type="submit" name="category" value="ALL">
          <input class="category" type="submit" name="category" value="UPPERWEAR">
          <input class="category" type="submit" name="category" value="BOTTOMS">
          <input class="category" type="submit" name="category" value="SHOES">
          <input class="category" type="submit" name="category" value="ACCESSORIES">
        </div>
      </form>
      <hr>
    </div>
  </div>

  <?php 
  if(isset($_GET['edit'])){
    if($_GET['edit'] == "success") {    ?>

  <div class="warning-label">
    <p>Item successfully edited</p>
  </div>

  <?php } } ?>


  <div class="products-center">

    <div class="products-container">

      <?php  
  
  // Loop over products using $row, which is an array that contains columns as indices.
  while($row = $result -> fetch_assoc()) {  ?>
      <div class="item-container">
        <a class="product-link"
          href="product.php?category=<?php print($row['type']); ?>&id=<?php print($row['id']); ?>">
          <div class="product">
            <img class='image-size' src="images/<?php print($row['image_src']); ?>"
              alt="<?php print($row['description']); ?> Image">
            <div class="description">
              <p><b><?php print($row["description"]); ?></b></p>
              <p class="type"><?php print($row["type"]); ?></p>
              <p><?php print("SAR ".$row["price"]); ?></p>
              <p><?php print("In Stock: ".$row["quantity"]); ?></p>
            </div>
          </div>
        </a>
        <div class='buttons-container'>
          <a class='button edit'
            href="Add.php?Category=<?php print($row['type'])?>&id=<?php print($row['id'])?>&description=<?php print($row['description'])?>&price=<?php print($row['price'])?>&quantity=<?php print($row['quantity'])?>&action=edit">Edit</a>
          <a class='button remove'
            href="Results.php?Category=<?php print($row['type'])?>&id=<?php print($row['id'])?>&action=delete">Remove</a>
        </div>
      </div>

      <?php }  ?>

    </div>
  </div>
  <?php }else{ ?>
  <div class="access-denied">
    <p>ACCESS DENIED</p>
    <p>No Admin Privileges</p>
  </div>
  <?php } ?>
  <?php include './reusables/Footer.php' ?>
</body>

</html>