<?php
//Check if session exists
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['id'])) {
    header('Location: index.php');
    die();
}