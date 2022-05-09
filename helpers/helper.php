<?php 

  // Return by reference so cart item can be edited
  function &checkIfInCart(string $category, int $id) {
    // Init as empty in case item wasn't found in cart
    $empty = '';
    for($i = 0; $i < count($_SESSION['cart']); $i++){
      if($_SESSION['cart'][$i][0] == $category && $_SESSION['cart'][$i][1] == $id){
        return $_SESSION['cart'][$i];
      }
    }
    return $empty;
  }

  // Adds selected quantity to an existing item's quantity in the cart
  function addToQuantity(array $found_product, int $quantity) {
    return ($found_product[2] + $quantity);
  }
  
  // Returns num of items in the cart
  function calculateNumOfItems() {
    $numOfItems = 0;
    if(isset($_SESSION['cart'])) {
      for($i = 0; $i < count($_SESSION['cart']); $i++){
        $numOfItems += $_SESSION['cart'][$i][2];
      }
    }
    return $numOfItems;
  }

  // Returns cart total
  function calculateTotal() {
    $total = 0;
    if(isset($_SESSION['cart'])) {
      $database = connectToDatabase();
      for($i = 0; $i < count($_SESSION['cart']); $i++){
        $query = "SELECT price FROM ".$_SESSION['cart'][$i][0]." WHERE id = ".$_SESSION['cart'][$i][1];
        $result = queryDatabase($database, $query)->fetch_row();
        $total += ($result[0] * $_SESSION['cart'][$i][2]);
      }
      disconnectFromDatabase($database);
    }
    return $total;
  }

?>