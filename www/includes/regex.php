<?php

    if(isset($_POST["submit"])){
        $allowed=array('jpg','png');
        $filename=$_FILES['imagen']['name'];
        $ext=pathinfo($filename,PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed)){
            echo "ez da irudia";
        } else {
            echo "irudia da";
        }

    }
?>

<form method="post">
    <input name="imagen" accept="imagen\jpeg,imagen\png" type="file" />
    <input type="submit" name="submit"/>
</form>