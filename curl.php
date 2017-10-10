<?php

class Download{

    const URL_MAX_LENGHT = 2050;

    protected function cleanUrl($url){
        if (isset($url)){
            if (!empty($url)){
                if (strlen($url) < self::URL_MAX_LENGHT){
                    return strip_tags($url);
                }
            }
        }
    }

    // validate url
    protected function isUrl($url){
        $url = $this->cleanUrl($url);
        if (isset($url)){
            if (filter_var($url,FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)){
                return $url;
            }
        }
    }

    protected function returnExtension($url){
        if ($this->isUrl($url)){
            $end = end(preg_split("/[.]+/",$url));
            if (isset($end)){
                return $end;
            }
        }
    }



    // download file function
    public function downloadFiles($url){
        if ($this->isUrl($url)){
            $extension = $this->returnExtension($url);

            // return name of file form url with extension
            //echo basename($url);die();

            if ($extension){

                $ch = curl_init();
                curl_setopt($ch , CURLOPT_URL , $url);
                curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);
                $result = curl_exec($ch);
                curl_close($ch);


                $destination = "download/file.".$extension;
                $file = fopen($destination,"w+");
                fputs($file,$result);
                if (fclose($file)){
                    echo "File Download...";
                }


            }
        }
    }


}

$_Obj = new Download();
if (isset($_POST['url'])){ $url = $_POST['url']; }

?>




<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" name="url">
    <input type="submit" value="Download">
</form>


<?php
if (isset($url)){
    $_Obj->downloadFiles($url);
}
?>
