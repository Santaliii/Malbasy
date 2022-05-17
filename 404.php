<?php 

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/404.css" type="text/css">
  <title>404 Not Found</title>
</head>

<body>

  <?php include './reusables/Header.php' ?>

  <img class="warning-image" src="images/Malbasy/404.png" alt="404 Not Found Warning Image">

  <h1 class="not-found">The page you're looking for doesn't exist :(</h1>


  <?php include './reusables/Footer.php' ?>
</body>

</html>