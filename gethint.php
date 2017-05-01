<?php
require 'connect.php';

$query  = "select username, user_id ";
$query .= "from users ";
$pal_result_set = mysqli_query($connection, $query);

$q = $_REQUEST["q"];
$hint = "";
while ($pal = mysqli_fetch_assoc($pal_result_set)) {

    $name = $pal['username'];

    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);

            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= ", $name";
                }
            }

    }
}
echo $hint === "" ? "no suggestion" : $hint;