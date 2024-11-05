<?php 
$db_host = "localhost";
$db_name = "test";
$db_username = "root";
$db_password = "";

$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_username, $db_password);

?>