<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');

$database = connectToDatabase();
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/purchases.css">
  <title>Past Purchases</title>
</head>

<body>

  <?php include './reusables/Header.php' ?>

  <div class="purchases-title">
    <h1>Past Purchases</h1>
  </div>

  <?php if(isset($_COOKIE['numOfOrders'])) {
          if($_COOKIE['numOfOrders'] == 0){ ?>

  <div class="no-orders">
    <p>You have not ordered any items yet.</p>
  </div>

  <?php }} ?>

  <div class="purchases-container">
    <?php 
     $query = "SELECT * FROM `order`";
     $result = queryDatabase($database, $query);
     while($row = $result->fetch_assoc()){
       $orderID = $row['id'];
       $orderTotal = $row['order_total'];
       $dateOrdered = $row['date_ordered'];
    ?>
    <div class="order">
      <div class="order-header">
        <?php print("Order #".$orderID." - ".$dateOrdered); ?>
      </div>
      <div class="order-container">
        <?php 
          $query = "SELECT * FROM `order_products` WHERE order_id = $orderID";
          $innerResult = queryDatabase($database, $query); 
        while($innerRow = $innerResult->fetch_assoc()){ 
          $imageSource = $innerRow['image_src'];
          $productTitle = $innerRow['description'];
          $productCategory = $innerRow['type'];
          $productPrice = $innerRow['price']; 
          $quantityOrdered = $innerRow['quantity'];
      ?>
        <div class="order-content">
          <div class="image">
            <img src="./images/<?php print($imageSource); ?>" alt="<?php print($productTitle) ?> Image">
          </div>
          <div class="product-description">
            <div class="product-title"><?php print($productTitle) ?></div>
            <div class=" product-category"><?php print($productCategory) ?>
            </div>
            <div class="product-price">SAR <?php print($productPrice) ?></div>
          </div>
          <div class="product-quantity">
            <p><b>Quantity</b></p>
            <p><?php print($quantityOrdered); ?></p>
          </div>
          <div class="product-subtotal">
            <p>Item Subtotal</p>
            <p>SAR <?php print($productPrice * $quantityOrdered); ?></p>
          </div>
        </div>
        <hr>
        <?php } ?>
        <div class="order-total">
          <p>TOTAL (Excluding Shipping)</p>
          <p><?php print("SAR ".$orderTotal); ?></p>
        </div>
        <hr>
      </div>
    </div>
    <?php } ?>
  </div>

  <script>
  let orderHeader = document.getElementsByClassName("order-header");
  for (let i = 0; i < orderHeader.length; i++) {
    orderHeader[i].addEventListener("click", function() {
      /* Toggle between adding and removing the "active" class,
      to highlight the button that controls the panel */
      this.classList.toggle("active");

      /* Toggle between hiding and showing the active panel */
      let order = this.nextElementSibling;
      if (order.style.maxHeight) {
        order.style.maxHeight = null;
      } else {
        order.style.maxHeight = order.scrollHeight + "px";
      }
    });
  }
  </script>

  <?php include './reusables/Footer.php' ?>
</body>

</html>