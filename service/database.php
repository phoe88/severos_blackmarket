<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "severos_blackmarket";

$db = mysqli_connect($hostname, $username, $password, $database);

if($db->connect_error){
    die("gabisa connect");
}else{
    echo "connectnya masuk bro";
}


?>