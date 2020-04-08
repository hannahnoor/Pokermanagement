<?php
//connectToDatabase
$host = "localhost";
$databaseName = "poker_manager";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "root";     //root is default in most cases
$password = "root";     //root is default in most cases


$conn = new PDO($connectionString, $username, $password);

//enables exception mode, exception is throw when an error occurs
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);