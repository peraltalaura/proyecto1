<?php
    function userExists($username){
        include("conf.php");
        include("mysql.php");
        $creds = mysqli_query($conx,"SELECT * FROM users WHERE username='". $username ."'");

        $creds = mysqli_fetch_array($creds);
        if($creds){
            return true;
        }
        return false;
    }

    function productExists($product_name){
        include("conf.php");
        include("mysql.php");
        $creds = mysqli_query($conx,"SELECT * FROM produktuak WHERE izena='". $product_name ."'");

        $creds = mysqli_fetch_array($creds);
        if($creds){
            return true;
        }
        return false;
    }

    function testuaDa($testua){
        $nombres="/^[a-zA-ZñáéíóúÁÉÍÓÚäëïöüÄËÏÖÜ\s]+$/";

        if(!preg_match($nombres,$testua)){
            return false;
        }

        return true;
    }

    function irudiaDa($irudia){
        $allowed=array('jpg','png');
        $ext=pathinfo($irudia,PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed)){
            return false;
        }

        return true;
    }

    function escape($html) {
        $htmlsanitizado=htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
        $htmlsanitizado=strip_tags($html);
        return $htmlsanitizado;
    }
?> 