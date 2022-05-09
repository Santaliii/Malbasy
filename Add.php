<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');


include 'reusables/Header.php';

if(!isset($_GET['Category'])){
  $_GET['Category'] = "";
}

?>

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" href="styles/add.css">
  <script src="javascript/formValidation.js"></script> <!-- FORM VALIDATION JAVASCRIPT FILE -->
  <title>Malbasy - Modify</title>
</head>


<body>

  <?php if(isset($_SESSION['admin'])){ ?>

  <div class='title'>
    <h1>Add/Modify</h1>
    <hr>
  </div>

  <?php 
  if(isset($_GET['add'])){
    if($_GET['add'] == "success") {    ?>

  <div class="warning-label">
    <p>Item successfully added</p>
  </div>

  <?php } } ?>





  <div class="form-container">

    <form action="Results.php" method="post" autocomplete="off" enctype="multipart/form-data"
      onsubmit="return addFormValidate(this)" name="AddForm">

      <input type="hidden" name="id" value="<?php if(isset($_GET['id'])) print($_GET['id']); ?>">


      <div>

      </div>

      <div class="input-container">

        <div class="input-name">
          Type:
        </div>

        <select class="input" name="type" id="Category">
          <option value="Upperwear" <?php if($_GET['Category'] == 'Upperwear') { print("selected"); } ?>>
            Upperwear</option>
          <option value="Bottoms" <?php if($_GET['Category'] == 'Bottoms') { print("selected"); } ?>>
            Bottoms</option>
          <option value="Shoes" <?php if($_GET['Category'] == 'Shoes') { print("selected"); } ?>>Shoes
          </option>
          <option value="Accessories" <?php if($_GET['Category'] == 'Accessories') { print("selected"); } ?>>Accessories
          </option>
        </select>
      </div>

      <div class="input-container">

        <div class="input-name">
          Product Name:
        </div>

        <div>
          <input class="input" type="text" id="name" name="name"
            value="<?php if(isset($_GET['description'])) print($_GET['description']); ?>">
        </div>
      </div>

      <div class="input-container">
        <div class="input-name">
          Price:
        </div>

        <div>
          <input class="input" type="text" id="price" name="price"
            value="<?php if(isset($_GET['price'])) print($_GET['price']);  ?>">
        </div>

      </div>

      <div class="input-container">

        <div class="input-name">
          Quantity:
        </div>

        <div>
          <input class="input" type="text" id="quantity" name="quantity"
            value="<?php if(isset($_GET['quantity'])) print($_GET['quantity']); ?>">
        </div>

      </div>

      <div class="input-container">
        <div class="input-name">
          Image:
        </div>

        <div>
          <input class="image-file" type="file" name="image" id="image">
        </div>

      </div>

      <div class="input-container">
        <input class='insert-button' type="submit" id="action" name="action"
          value="<?php if(isset($_GET['action'])) { if($_GET['action'] == "edit"){ print("Edit"); }} else { print("Insert"); } ?> ">
      </div>
    </form>
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