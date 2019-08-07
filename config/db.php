<?php


$host= "localhost";
$dbName = "movies";
$userName = 'admin';
$password = 'admin';

$conn = mysqli_connect($host, $userName, $password, $dbName);

if (!$conn) {
    die('failed');
}
?>
