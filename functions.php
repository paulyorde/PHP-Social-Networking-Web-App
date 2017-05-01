<?php

function redirect_user ($page = 'sign-up.php')
{
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;

    header("Location: $url");
    exit();
}

function check_login($connection, $email = '', $pass = '')
{

    $errors = array();

    if (empty($email))
    {
        $errors[] = 'You forgot to enter your email address.';
    }
    else {
        $e = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
    }

    if (empty($pass))
    {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $p = mysqli_real_escape_string($connection, trim($pass));
    }

    if (empty($errors))
    {
        // can select username here , which is name to use in app
        $q = "SELECT user_id, username FROM users WHERE email='$e' AND password=SHA1('$p')";
        $r = @mysqli_query ($connection, $q);

        if (mysqli_num_rows($r) == 1)
        {
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
            // create user object
            //$user = new User($row);
            return array(true, $row);
        }
        else
        {
            $errors[] = 'The email address and password entered do not match those on file.';
        }
    }
    return array(false, $errors);

}
