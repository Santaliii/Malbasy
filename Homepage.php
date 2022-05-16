<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');


if(isset($_GET['category']) &&
 ($_GET['category'] == 'UPPERWEAR' || $_GET['category'] == 'BOTTOMS' || $_GET['category'] == 'SHOES' || $_GET['category'] == 'ACCESSORIES')){
  if(isset($_POST['sort']) && ($_POST['sort'] == 'Highest' || $_POST['sort'] == 'Lowest')){
    $sort = 'ASC';
  if($_POST['sort'] == 'Highest')
    $sort = 'DESC';
    $query = "SELECT * FROM ".$_GET['category']." ORDER BY price $sort";
  }
  else{
    $query = "SELECT * FROM ".$_GET['category'];
  }

 }
else if(isset($_POST['sort']) && ($_POST['sort'] == 'Highest' || $_POST['sort'] == 'Lowest')){
  $sort = 'ASC';
  if($_POST['sort'] == 'Highest')
    $sort = 'DESC';
  $query = "SELECT * FROM upperwear
    UNION SELECT * FROM bottoms
    UNION SELECT * FROM shoes 
    UNION SELECT * FROM accessories
    ORDER BY price $sort";
}
else {
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

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" type="text/css" href="styles/homepage.css">
  <title>Malbasy - Homepage</title>
</head>

<body>

  <?php include 'reusables/Header.php' ?>

  <div class="products-top">
    <img class="homepage-logo" src="images/Malbasy/Logo.png" alt="Malbasy Logo">
    <form id="filter-form" action="Homepage.php">
      <div class="category-buttons">
        <input class="category" type="submit" value="ALL">
        <input class="category" type="submit" name="category" value="UPPERWEAR">
        <input class="category" type="submit" name="category" value="BOTTOMS">
        <input class="category" type="submit" name="category" value="SHOES">
        <input class="category" type="submit" name="category" value="ACCESSORIES">
      </div>
    </form>
    <hr>

  </div>

  <div class="products-center">

    <div class="price-sort">
      <div class="price-heading">
        <img src="./images/Malbasy/Sort.png" alt="Sort Icon">
        <p>Price</p>
      </div>

      <form class="sort-buttons" method="post" action="">
        <input class="category sort" type="submit" name="sort" value="Highest">
        <input class="category sort" type="submit" name="sort" value="Lowest">
      </form>

    </div>

    <div class="products-container">
      <?php  
      // Loop over products using $row, which is an array that contains columns as indices.
      while($row = $result -> fetch_assoc()) {  ?>
      <a class="product-link" href="product.php?category=<?php print($row['type']); ?>&id=<?php print($row['id']); ?>">
        <div class="product">
          <img src="images/<?php print($row['image_src']); ?>" alt="<?php print($row['description']); ?> Image">
          <div class="description">
            <p><b><?php print($row["description"]); ?></b></p>
            <p><?php print("SAR ".$row["price"]); ?></p>
            <?php if($row['quantity'] <= 0){ ?>
            <div style="color: red;">Out of Stock</div>
            <?php } ?>
          </div>
        </div>
      </a>
      <?php }  ?>
    </div>
  </div>

  <?php include './reusables/Footer.php' ?>

</body>

</html>