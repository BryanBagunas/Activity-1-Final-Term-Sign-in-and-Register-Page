<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "calisthenics_db";

//create database connection
$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("connection failed: " . mysqli_connect_error());
}

//set character encoding
mysqli_set_charset($conn, "utf8mb4");
?>