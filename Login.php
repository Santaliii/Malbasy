<?php 
session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');
include 'reusables/Header.php';

$isLoginSuccessful = true;
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $encryptedPass = hash("sha256", $_POST['password']);

$query = "SELECT username, password FROM admin where username = '$username' AND password = '$encryptedPass'";
$database = connectToDatabase();
$result = queryDatabase($database, $query);


if(mysqli_num_rows($result) == 0){
  $isLoginSuccessful = false;
}
else {
  // $isLoginSuccessful = true;
  header('Location: Edit.php');
  $_SESSION['admin'] = $username;
}


}


?>


<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" href="styles/login.css">
  <script src="javascript/formValidation.js"></script> <!-- FORM VALIDATION JAVASCRIPT FILE -->
  <title>Malbasy - Modify</title>
</head>


<body>

  <div class="form-container">

    <div class="login-label">
      Admin Login
    </div>

    <?php if(!$isLoginSuccessful) {    ?>

    <div class="warning-label">
      <p>Incorrect username or password</p>
    </div>

    <?php } ?>

    <form action="Login.php" method="post" onsubmit="return loginFormValidate(this)" name="LoginForm" id="LoginForm"
      autocomplete="off">


      <div class="input-name">
        Username
      </div>
      <input class="input <?php !$isLoginSuccessful ? print("wrong") : '' ?>" type="text" name="username">


      <div class="input-name">
        Password
      </div>
      <input class="input <?php !$isLoginSuccessful ? print("wrong") : '' ?>" type="password" name="password">


    </form>
    <input class="signin-button" type="submit" name="login" value="Sign In" form="LoginForm">

  </div>


  <?php include './reusables/Footer.php' ?>


</body>