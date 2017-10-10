<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image" >
    <input type="submit" value="POST">
</form>

<?php

if (isset($_FILES) && !empty($_FILES)){
    if (isset($_FILES['image']['tmp_name'])){
        $ch = curl_init();
        $cfile = new CURLFile($_FILES['image']['tmp_name'],$_FILES['image']['type'],$_FILES['image']['name']);
        $data = array('myImage' => $cfile);

        // url may be any inside or outside domain
        curl_setopt($ch ,CURLOPT_URL , "http://localhost/CURL/Next/upload.php");
        curl_setopt($ch , CURLOPT_POST , true);
        curl_setopt($ch , CURLOPT_POSTFIELDS , $data);

        $response = curl_exec($ch);

        if ($response){
            echo "File posted..";
        }else{
            echo "Error : ".curl_error($ch)." Error no. ".curl_errno($ch);
        }
    }
}




?>