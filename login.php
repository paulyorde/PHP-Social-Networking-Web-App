<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require 'functions.php';
    require 'connect.php';

    list ($check, $data) = check_login($connection, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL), $_POST['pass']);

    if ($check) {

        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data ['username'];
        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

        redirect_user('home.php');
    } else {
        $errors = $data;
    }

    mysqli_close($connection);

}

include 'login-page.php';
?>