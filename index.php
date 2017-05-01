<?php
session_start();
if ($_SESSION['loggedin'] == true)
{
    include 'functions.php';
    redirect_user('home.php');
} else {
    include 'functions.php';
    redirect_user('sign-up.php');
}