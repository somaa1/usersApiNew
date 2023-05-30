<?php
include 'db_helper.php';
header("Content-Type:application/json");
$db_helper = new DbHelper();
$db_helper->createDbConnection();
if($_SERVER["REQUEST_METHOD"]=="POST"){
$name = $_POST["username"];
$email = $_POST["password"];
$email = $_POST["email"];
$image = $_POST["image"];

$db_helper->insertNewStudent($username,$password,$email,$image);
}
?>