<?php 

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');

$notAllowed = false;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_POST['submit'])){
  date_default_timezone_set('Asia/Riyadh');
  createOrder();
  $database = connectToDatabase();
  // Edit quantity
  for($i = 0; $i < count($_SESSION['cart']); $i++) {
    $category = $_SESSION['cart'][$i][0];
    $id = $_SESSION['cart'][$i][1];
    $quantity = $_SESSION['cart'][$i][2];
    $query = "UPDATE ".$category." SET quantity = quantity - ".$quantity." WHERE id = ".$id;
    queryDatabase($database, $query);
  }
  disconnectFromDatabase($database);
  // Clearing the 'cart' session
  unset($_SESSION['cart']);
}
else{
  $notAllowed = true;
}


function createOrder() {
  $orderTotal = calculateTotal();
  $date = date('d/m/Y');
  $query = "INSERT INTO `order` (order_total, date_ordered) VALUES ('$orderTotal', '$date')";
  $database = connectToDatabase();
  $orderID = insertAndGetID($database, $query);
  for($i = 0; $i < count($_SESSION['cart']); $i++) {
    // Get information of the product in cart
    $type = $_SESSION['cart'][$i][0];
    $id = $_SESSION['cart'][$i][1];
    $quantity = $_SESSION['cart'][$i][2];
    // Get all information of current product
    $row = queryDatabase($database, "SELECT * FROM $type WHERE id = $id")->fetch_assoc();
    $description = $row['description'];
    $price = $row['price'];
    $imageSource = $row['image_src'];
    $query = "INSERT INTO `order_products` (order_id, type, description, price, quantity, image_src) VALUES ('$orderID', '$type', '$description', '$price', '$quantity', '$imageSource')";
    queryDatabase($database, $query);
  }
  disconnectFromDatabase($database);

}


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/checkout.css">
  <title>Checkout</title>
</head>

<body>

  <?php include './reusables/Header.php' ?>
  <img class="homepage-logo" src="images/Malbasy/Logo.png" alt="Malbasy Logo">

  <?php $notAllowed ? header('Location: 404.php') : ''; ?>

  <div class="order-success">
    <h1>Purchase Successful!</h1>
    <a class="goto-purchases" href="Purchases.php"> <em>Go to Purchases</em> </a>
  </div>

  <?php include './reusables/Footer.php' ?>

</body>

</html>