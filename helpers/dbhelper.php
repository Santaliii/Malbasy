<?php 

function connectToDatabase() {
  if(!($database = mysqli_connect("localhost", "root", "")))
    die("Could not connect to database </body></html>");
  if(!mysqli_select_db($database, "malbasy"))
    die("Could not open malbasy database </body></html>");
  return $database;
}

function queryDatabase ($database, string $query){
  if(!($result = mysqli_query($database, $query))){
    print("Could not execute query!");
    die(mysqli_error($database)."</body></html>");
  }
  return $result;
}

function insertAndGetID($database, string $query) {
  mysqli_query($database, $query);
  return mysqli_insert_id($database);
}

function disconnectFromDatabase($database) {
  mysqli_close($database);
}

?>