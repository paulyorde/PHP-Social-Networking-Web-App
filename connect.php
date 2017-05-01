<?php
$dbhost = "localhost:3308";
$dbuser = "root";
$dbpass = "Mojojojo1";
$dbname = "movie_pal";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test if connection succeeded
if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}