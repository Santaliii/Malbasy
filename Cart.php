<?php 

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');

$database = connectToDatabase();

if(isset($_SESSION['cart'])) {
  // If an item was chosen to be removed
  if(isset($_GET['category']) && isset($_GET['id'])){
    // Get the item
    $item = checkIfInCart($_GET['category'], $_GET['id']);
    if(!empty($item)){
      // Get its index
      $indexToDelete = array_search($item, $_SESSION['cart']);
      // Remove it from the cart
      unset($_SESSION['cart'][$indexToDelete]);
      // Reset the indexes of the session array
      $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
  }
  else if(isset($_POST['empty'])){
    unset($_SESSION['cart']);
  }
  else{
    // Updates quantity of cart
    foreach($_POST as $key => $value) {
      // Splits the product key which is in the form "category_id" into an array of [category, id]
      $compositeKey = explode("_", $key);
      $category = $compositeKey[0];
      $id = $compositeKey[1];
      $productToFind = array_search(checkIfInCart($category, $id), $_SESSION['cart']);
      // Setting the quantity of the product to the updated value
      $_SESSION['cart'][$productToFind][2] = $value;
    }
  }
}



isset($_GET['category']) ? header("Location: Cart.php") : ''

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/cart.css">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">

  <title>Malbasy - Cart</title>
</head>

<body>

  <?php include './reusables/Header.php' ?>

  <div class="main-cart">
    <div class="cart-heading">
      <img src="./images/Malbasy/Shopping Bag.png" alt="Shopping Bag Image">
      <h1>Shopping Bag</h1>
    </div>
    <form id="empty_cart" action="" method="post"></form>
    <div class="above-cart">
      <div class="empty-cart">
        <img src="./images/Malbasy/Empty.png" alt="Empty Bag Image">
        <input class="empty-button" form="empty_cart" type="submit" name="empty" value="Empty Bag">
      </div>
      <div class="free-shipping">
        <h1>FREE SHIPPING ON ORDERS ABOVE <span>SAR 100</span>!</h1>
      </div>
    </div>
    <hr>
    <?php if(empty($_SESSION['cart'])){ ?>
    <div class="display-empty">
      <h1>Your Shopping Bag is Empty! :(</h1>
      <a class="shop-link" href="Homepage.php"><em>Shop Now!</em></a>
    </div>
    <?php }else{ ?>
    <div class="cart-container">

      <div class="products-container">
        <?php
          for($i = 0; $i < count($_SESSION['cart']); $i++) {
            $category = $_SESSION['cart'][$i][0];
            $id = $_SESSION['cart'][$i][1];
            $quantity = $_SESSION['cart'][$i][2];
            $query = "SELECT * FROM ".$category." WHERE id = ".$id;
            $result = queryDatabase($database, $query);
            $row = $result -> fetch_assoc(); 
            $imageSource = $row['image_src'];
            $productTitle = $row['description'];
            $productCategory = $row['type'];
            $productPrice = $row['price']; 
            $maxQuantity = $row['quantity']; ?>
        <div class="product">
          <div class="product-image">
            <img src="./images/<?php print($imageSource) ?>" alt="<?php print($productTitle." Image") ?>">
          </div>
          <div class="product-description">
            <div class="product-title"><?php print($productTitle) ?></div>
            <div class="product-category"><?php print($productCategory) ?></div>
            <div class="product-price">SAR <?php print($productPrice) ?></div>
          </div>

          <div class="product-quantity">
            <h6>Quantity</h6>
            <form action="" method="post">
              <input name="<?php print($category."_".$id); ?>" value="<?php print($quantity) ?>" min="1"
                max="<?php print($maxQuantity) ?>" class="
              quantity-input" type="number" onkeydown="return false">
              <input class="update-quantity" type="submit" value="Update">
            </form>
          </div>
          <div class="product-subtotal">
            <h6>Item Subtotal</h6>
            <h6>SAR <?php print($productPrice * $quantity); ?></h6>
          </div>
          <div class="delete-icon">
            <a href="<?php print("?category=".$category."&id=".$id); ?>"><img src="./images/Malbasy/Remove.png"
                alt="Remove item"></a>
          </div>
        </div>
        <hr>
        <?php } ?>
      </div>
      <hr class="vertical-rule">
      <div class="cost-container">
        <div class="cart-line">
          <h6>SUBTOTAL</h6>
          <h6><?php $subtotal = calculateTotal(); print("SAR ".$subtotal) ?></h6>
        </div>
        <div class="cart-line">
          <h6><b>SHIPPING</b></h6>
          <h6>
            <?php 
              $shipping = 0; 
              if($subtotal >= 100){
                print("FREE");
              }
              else {
                $shipping = 35;
                print("SAR ".$shipping);
              }
            ?>
          </h6>
        </div>
        <hr>
        <div class="cart-line total">
          <h6>TOTAL</h6>
          <h6>
            <?php
              $total = $subtotal + $shipping;
              print("SAR ".$total); 
            ?>
          </h6>
        </div>
        <form action="Checkout.php" method="post">
          <input class="checkout-button" name="submit" type="submit" value="Checkout">
        </form>
      </div>
    </div>
  </div>
  <?php } ?>

  </div>


  <?php include './reusables/Footer.php' ?>
</body>

<script>

</script>


</html>