<?php
session_start();
if ($_SESSION['loggedin'] == true)
{
    include '../functions.php';
    redirect_user('home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Movie Pal | Sign IN</title>

    <style>
        body {
            background: #EDEDEC !important;
            padding-top:50px;
        }
        ul {
            padding:0;
        }

        a {
            color: #d9edf7 !important;
        }

        .navbar-brand {
            color: #f0ad4e !important;
            font-size: x-large;
        }

        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            color: #555;
            background-color: #442121;
        }

        .btn-default {
            color: #333;
            background-color: #071B1B;
            border-color: #ccc;
        }
        .navbar-style {
            padding: 0;
            margin: 0;
            border: none;
            border-radius:inherit;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+87,7a6153+100,89725d+100 */
            background: #000000; /* Old browsers */
            background: -moz-linear-gradient(top,  #000000 87%, #7a6153 100%, #89725d 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  #000000 87%,#7a6153 100%,#89725d 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  #000000 87%,#7a6153 100%,#89725d 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#89725d',GradientType=0 ); /* IE6-9 */

        }

        .jumbo-text {
            /*color:rgba(118, 28, 25, 1);*/
            color:#003f54;

        }
        .jumbotron {
            background: rgba(165, 42, 42, 0.1) !important;
            /*background:rgba(172, 186, 114, 0.25) !important;*/
            /*background: #72a3ba !important;*/
            /*background:#523030 !important;*/
            margin: 0;
            padding: 0;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</head>
<body>

<!--NAV-->
<nav class="navbar navbar-default navbar-style navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">movie pal</a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php

if (isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
}
