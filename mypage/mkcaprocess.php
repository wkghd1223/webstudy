<?php
require("./config.php");
require("./db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
 
$category = mysqli_real_escape_string($conn, $_POST['category']);
 
$sql = "SELECT * FROM user WHERE name='".$category."'";
$result  = mysqli_query($conn, $sql);
if($result->num_rows == 0){
  $sql = "INSERT INTO user (name, password) VALUES('".$category."', 'root')";
  mysqli_query($conn, $sql);
  $user_id = mysqli_insert_id($conn);
} else {
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];
}
$sql = "INSERT INTO menu (category) VALUES('".$category."')";
$result = mysqli_query($conn, $sql);
header('Location: ./index.php');
?>