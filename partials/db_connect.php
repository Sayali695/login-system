<?php

$server = "localhost";
$username="root";
$password="";
$database="users";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("The Database is not connected". mysqli_connect_error());
}
