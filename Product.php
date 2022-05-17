<?php 

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');

$categories = array("UPPERWEAR", "BOTTOMS", "ACCESSORIES", "SHOES");
$success = false;
$error = false;

if((!isset($_GET['category']) || empty($_GET['category'])) || (!isset($_GET['id']) || empty($_GET['id']))){
  header('Location: 404.php');
}
else if(!in_array(strtoupper($_GET['category']), $categories)){
  header('Location: 404.php');
}


// If session cart is empty then initialize it as an empty manipulable array
if(empty($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}

// If the 'add to cart' button was submitted
if(isset($_POST['quantity'])){

  
  // Get the available quantity of the selected product from the DB.
  $query = "SELECT quantity FROM ".$_GET['category']." WHERE id = ".$_GET['id'];
  $database = connectToDatabase();
  $result = queryDatabase($database, $query);
  disconnectFromDatabase($database);

  
  $row = $result -> fetch_row();
  $currentQuantity = $row[0];
  if($_POST['quantity'] <= $currentQuantity){
    
    // Checks if the added item was already in the cart. If it does, assign a reference of it to variable
    $productToFind = &checkIfInCart($_GET['category'], $_GET['id'], $_POST['quantity']);
    // If the item exists in the cart
    if(!empty($productToFind)) {
      // Add the selected quantity to its existing quantity and check if they are less than the available stock
      $finalQuantity = addToQuantity($productToFind, $_POST['quantity']);
      if($finalQuantity <= $currentQuantity) {
        $productToFind[2] += $_POST['quantity'];
        $success = true;
      }
      else
        $error = true;
    }
    else{
      array_push($_SESSION['cart'], array($_GET['category'], $_GET['id'], $_POST['quantity']) );
      $success = true;
    }

  }
  else {
    $error = true;
  }
}

// DB connection to initially display the product
$query = "SELECT * FROM ".$_GET['category']." WHERE id = ".$_GET['id'];
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
  <link rel="stylesheet" type="text/css" href="styles/product.css">

  <title> <?php print("Malbasy - ".$_GET['category']) ?> </title>
</head>

<body>

  <?php include 'reusables/Header.php' ?>
  <div class="logo">
    <img src="./images/Malbasy/Logo.png" alt="Malbasy big logo">
  </div>
  <?php 
   // If the selected quantity exceeds that in the database then display an error message.
   if($error){ ?>
  <div class="notification error">
    Could not add item to shopping cart, quantity exceeded!
  </div>
  <?php }else if($success){ ?>
  <div class="notification success">
    Successfully added item to cart
  </div>
  <?php } ?>

  <div class="main-container">
    <?php 
        // Loop through the returned results
        while($row = $result -> fetch_assoc()) { ?>
    <?php $quantity = $row['quantity']; ?>
    <div class="product-information">
      <img class="product-image" src="./images/<?php print($row['image_src']) ?>" alt="">
      <div class="product-description">
        <div class="product-title"><?php print($row['description']); ?></div>
        <p class="product-category"><?php print($row['type']); ?></p>
        <p class="product-price">SAR <?php print($row['price']) ?></p>
        <form id="product-form" action="" method="POST">
          <p>Quantity</p>
          <input name="quantity" value="<?php $quantity > 0 ? print('1') : print('0') ?>" min="1"
            max="<?php print($quantity) ?>" class="quantity-box" type="number" onkeydown="return false">
          <p><b style="color: red;"><?php print($quantity) ?></b> pieces left in stock.</p>
        </form>
        <ul>
          <li>High Quality Materials</li>
          <li>Ethically Made</li>
          <li>Cheapest Prices</li>
        </ul>
      </div>
    </div>
    <?php if($quantity > 0) { ?>

    <?php if(!isset($_SESSION['admin'])) { ?>

    <input form="product-form" class="add-to-cart" type="submit" name="submit" value="Add To Cart">

    <?php }else{ ?>

    <div class="out-of-stock">
      Cannot shop in admin mode
    </div>

    <?php } ?>

    <?php }else{ ?>
    <div class="out-of-stock">
      Out of Stock
    </div>
    <?php }} ?>
    <hr>





  </div>

  <?php include './reusables/Footer.php' ?>
</body>

</html>