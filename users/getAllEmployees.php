<?php
include 'db_helper.php';
header("Content-Type:application/json");
$db_helper = new DbHelper();
$db_helper->createDbConnection();
if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(isset($_GET["id"])){
        $db_helper->getEmployeesById($_GET["id"]);
    }else{
        $db_helper->getAllEmployees();
    }


}
?>