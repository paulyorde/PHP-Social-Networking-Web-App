<?php
require_once 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $result = $con->query('select filetype, ImageData from images where ImageId = ' . $id);
    if ($result) {
        $image = $result->fetch_object();
        $type = $image->filetype;
        $data = $image->ImageData;
        header("Content-Type: " . $type);
        echo $data;
    } else {
        echo $con->error;
    }
}
else {
    echo 'not get set';
}