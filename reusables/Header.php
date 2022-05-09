<?php 
if(!isset($_COOKIE['numOfOrders'])){
  setcookie("numOfOrders", 0, time() + (86400 * 60));
}
?>

<link rel="stylesheet" href="styles/header.css">

<header class="header">
  <nav class="link-container">
    <div class="logo-desc">
      <img src="images/Malbasy/Small Logo.jpg" alt="Malbasy Small Logo">
      <a class="link malbasy" href="Homepage.php">Malbasy</a>
    </div>
    <?php 
    // If an admin is logged in, show different options
        if(isset($_SESSION['admin'])){ ?>
    <div class="admin-links">
      <a class="admin-link" href="Edit.php">Modify Products</a>
      |
      <a class="admin-link" href="Add.php">Add a Product</a>
    </div>
    <?php }else{ ?>
    <div class="link-wrapper">
      <a class="link" href="Homepage.php">Shop Clothes</a>
      |
      <a class="link" href="Purchases.php">Past Purchases</a>
    </div>
    <?php } ?>
    <?php
     if(isset($_SESSION['admin'])){ ?>
    <a class="logout-button" href="Logout.php">Logout</a>

    <?php }else{ ?>
    <div class="cart-information">
      <a href="Cart.php">
        <div class="info-container">
          <?php $numOfItems =  calculateNumOfItems() ?>
          <p class="item-count" style="<?php calculateNumOfItems() < 10 ? print('left: 11px;') : ''; ?>">
            <?php print($numOfItems); ?></p>
          <img src="images/Malbasy/Bag.png" alt="Shopping Cart Logo">
        </div>
      </a>
      <div class="cart-preview">
        <p><?php print(calculateNumOfItems()); ?> Items</p>
        <p>-</p>
        <p>SAR <?php print(calculateTotal()); ?></p>
      </div>
    </div>
    <?php } ?>
  </nav>
  <div class="login-info">
    <?php
    // If an admin is not logged in, show the 'Admin Login' button.
     if(!isset($_SESSION['admin'])){ ?>
    <a class="login-button" href="Login.php">Admin Login</a>
    <?php }else{ ?>
    <p class="admin-name">Signed in as: <span><?php print($_SESSION['admin']);?></span> </p>
    <?php } ?>
  </div>

</header>