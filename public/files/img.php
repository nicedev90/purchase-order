<?php
//do your check here

if(isset($_SESSION['user_rol'])) {
    $remoteImage = $_GET["img"];
    $imginfo = getimagesize($remoteImage);
    header("Content-type: ".$imginfo['mime']);
    readfile($remoteImage);
        print_r($_SESSION['user_rol']);
}
else{
    echo "You are not logged in!";
    print_r($_SESSION['user_rol']);
}


?>