<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');

if(isset($_POST['action']) && isset($_SESSION['admin'])){
  $action = trim($_POST['action']);
  if($action == 'Insert'){

    $itemType = $_POST['type'];
    $itemName = $_POST['name'];
    $itemQuantity = $_POST['quantity'];
    $itemPrice = $_POST['price'];
    $itemImageSource = uploadImage();


    $query = "INSERT INTO $itemType (type, description, price, quantity, image_src) VALUES ('$itemType', '$itemName', '$itemPrice', '$itemQuantity', '$itemImageSource')";
    executeQuery($query);
    returnHome($action);

  }
  else if($action == 'Edit'){
    $itemID = $_POST['id'];
    $itemType = $_POST['type'];
    $itemName = $_POST['name'];
    $itemQuantity = $_POST['quantity'];
    $itemPrice = $_POST['price'];
    $itemImageSource = uploadImage();
    // If the image was not edited, get the current image
    if(empty($itemImageSource)){
      $q = "SELECT image_src FROM $itemType WHERE id = '$itemID'";
      $database = connectToDatabase();
      $result = queryDatabase($database, $q);
      $itemImageSource = $result -> fetch_assoc()['image_src'];
    }

    $query = "UPDATE $itemType SET type = '$itemType', description = '$itemName', price = '$itemPrice', quantity = '$itemQuantity', image_src = '$itemImageSource' WHERE type = '$itemType' AND id = '$itemID'";
    executeQuery($query);
    returnHome($action);
  }
}
else if(isset($_GET['action']) && isset($_SESSION['admin'])) {
  $action = trim($_GET['action']);
  if($action == 'delete'){

    $itemID = $_GET['id'];
    $itemType = $_GET['Category'];

    $query = "DELETE FROM $itemType WHERE type = '$itemType' AND id = '$itemID'";
    executeQuery($query);
    returnHome($action);
  }
  
}


function executeQuery($query){
  $database = connectToDatabase();
  $result = queryDatabase($database, $query);
  disconnectFromDatabase($database);
}

function returnHome($action){
  if($action == 'delete' || $action == 'Edit'){
    header("Location: Edit.php?edit=$action");
  }
  else if($action == 'Insert'){
    header("Location: Add.php?add=success");
  }
}


function uploadImage() {
  
  if(isset($_FILES['image'])){
    $target_dir = 'images/';
    $target_file = $target_dir.$_POST['type']."/".basename($_FILES["image"]["name"]);
    $target_subfile = $_POST['type']."/".basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
  
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        return $target_subfile;
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  return '';

}


?>
<!-- <html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" href="styles/Add.css">
  <title>Malbasy - Results</title>
</head>

<body>

  <?php if(isset($_SESSION['admin'])){ ?>

  <?php }else{ ?>
  <div class="access-denied">
    <p>ACCESS DENIED</p>
    <p>No Admin Privileges</p>
  </div>
  <?php } ?>



  <?php include './reusables/Footer.php' ?>
</body>



</html> -->