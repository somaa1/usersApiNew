<?php
include 'db_helper.php';
header("Content-Type:application/json");
$db_helper = new DbHelper();
$db_helper->createDbConnection();
if($_SERVER["REQUEST_METHOD"]=="POST"){
$username = $_POST["username"];
$password = $_POST["password"];

$email = $_POST["email"];
$image = $_POST["image"];

$db_helper->insertNewEmployee($username,$password,$email,$image);
}
?>
       