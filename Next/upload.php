<?php

if (isset($_FILES['myImage']['tmp_name'])){
    $path = "upload/".$_FILES['myImage']['name'];
    move_uploaded_file($_FILES['myImage']['tmp_name'],$path);
}

?>