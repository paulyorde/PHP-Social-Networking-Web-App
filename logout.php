<?php

session_start();

if (!isset($_SESSION['user_id']))
{
    require ('functions.php');
    redirect_user();

} else {

    $_SESSION = array();
    session_destroy();
    setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.
    $page_title = 'Logged Out!';
    include 'functions.php';
    redirect_user();
}
