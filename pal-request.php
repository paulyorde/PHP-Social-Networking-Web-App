<?php
session_start();
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
    require ('functions.php');
    redirect_user('index.php');
}


if ($_SESSION['user_id'] == null) {
    $current_user = null;
} else {
    $current_user = filter_var($_SESSION['user_id'],FILTER_SANITIZE_STRING);
}
if(isset($_GET['user']) ) {
    $username = filter_var($_GET['user'],FILTER_SANITIZE_STRING);
} else {
    $username = null;
}

if(isset($_POST['user']) ) {
    $username = filter_var($_POST['user'],FILTER_SANITIZE_STRING);
} else {
    $username = null;
}


$pal_request=null;
if ( (isset($_POST['pal'])) )
{
    $pal_request = filter_var($_POST['pal'],FILTER_SANITIZE_STRING);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query  = "insert into pals (pal_id, user_id) values ($current_user, $pal_request )";
    $success = mysqli_query($connection, $query);
    if($success) {
        echo "you are now pals with {$username}";
        ?><script>$('#request-form').hide();</script> <?php
    }
} else {
    echo 'Sorry friend request deigned';

}
