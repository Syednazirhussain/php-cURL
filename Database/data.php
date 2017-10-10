<?php

if (isset($_POST) && !empty($_POST)){
/*    echo "<pre>";
    echo print_r($_POST);*/

    if ( isset($_POST['name']) && isset($_POST['age']) ){
        $db = new mysqli("localhost","root","","postdata");
        $name  = $db->real_escape_string($_POST['name']);
        $age = (int)$_POST['age'];
        $querey = "insert into data set mydata = '$name,$age'";
        $db->query($querey);
    }

}


?>