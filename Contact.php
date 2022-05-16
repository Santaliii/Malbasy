<?php

session_start();

require('./helpers/helper.php');
require('./helpers/dbhelper.php');
include 'reusables/Header.php';

?>


<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon type" href="./images/Malbasy/Small Logo.jpg">
  <link rel="stylesheet" type="text/css" href="styles/contact.css">
  <img class="homepage-logo" src="images/Malbasy/Logo.png" alt="Malbasy Logo">
  <title>Malbasy - Contact Us</title>
</head>

<body>
  <h1 class="contact-title">Contact Us!</h1>
  <hr>

  <div id="map"></div>
  <script>
  function initMap() {
    var pin = {
      lat: 26.393493805155085,
      lng: 50.19452707284585
    };
    var mapOptions = {
      center: pin,
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    new google.maps.Marker({
      position: pin,
      map,
      animation: google.maps.Animation.DROP,
    });
  }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs0O_oh59uinS0iNhX2mT_UtU5fwTlJ4I&callback=initMap"
    async defer></script>


  <div class="contact-container">
    <div class="contact-item">
      <img src="images/Malbasy/location.png" alt="Location Icon">
      <h1>Address</h1>
      <p class="contact-text">
        1234, First Street,
        Dammam.</p>
    </div>
    <div class="contact-item">
      <img src="images/Malbasy/clock.png" alt="Working Hours Icon">
      <h1>Working Hours</h1>
      <p class="contact-text">
        Weekdays: 10am - 6pm
        Saturday: 12pm - 4pm</p>
    </div>
    <div class="contact-item">
      <img src="images/Malbasy/email.png" alt="Email Icon">
      <h1>Email</h1>
      <p class="contact-text">
        <a href="mailto:contact@malbasy.com">contact@malbasy.com</a>
      </p>
    </div>
  </div>

  <?php include './reusables/Footer.php' ?>


</body>

</html>