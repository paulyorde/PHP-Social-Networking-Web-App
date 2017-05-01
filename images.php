<?php
    session_start();
    $id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $con = new mysqli('localhost:3308', 'root', 'Mojojojo1', 'movie_pal');
        $allowedType = "image/png";

        if ( isset($_FILES['my_upload']) &&
            file_exists($_FILES['my_upload']['tmp_name']) ) {
            $tmpName = $_FILES['my_upload']['tmp_name'];

            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $fileType = $fileInfo->file($tmpName);

            if ($fileType == $allowedType) {
                // get image metadata
                $name = $_FILES['my_upload']['name'];
                $type = $_FILES['my_upload']['type'];

                $stream = fopen($tmpName, 'r'); // opens image file stream
                $data = fread($stream, filesize($tmpName)); // read from 0 to end
                $data = $con->real_escape_string($data);
                fclose($stream); // close image file stream

                $q = ("insert into images(FileName,filetype,ImageData, user_id)
                  values('$name','$type','$data', $id)");

                $success = $con->query($q);

                if ($success) {
                    include "functions.php";
                    redirect_user('password.php');
                } else {
                    echo $con->error . 'nope';
                }
            } else {
                echo "bad file!";
            }
        }
    }


