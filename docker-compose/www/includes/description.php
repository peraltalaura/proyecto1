<?php

/*if(isset($_GET['del_id'])){

  if(isset($_SESSION['admin']) && ($_SESSION['admin']==1)){
      mysqli_query($conx,"UPDATE produktuak SET descripzioa = '' WHERE ID LIKE ".$_GET['del_id']);
    header("Location: ".$_SERVER['PHP_SELF']);
  }else{
    header("Location: ".$_SERVER['PHP_SELF']);
  }

}*/

$error = array(
    'deskripzioa' 	=> '',
    'salneurria' => '',
);

if(isset($_GET['postdescription'])){
    $crntquery = mysqli_query($conx,"SELECT deskripzioa, salneurria FROM produktuak WHERE ID = ".$_GET['pic_id']);
    $crntcomm = mysqli_fetch_array($crntquery);
    $errores=false;
    include("funtzioak.php");
    $deskripzioa = escape($_POST['deskripzioa']);
    $salneurria = $crntcomm['salneurria'];

    if(str_replace(' ','',$deskripzioa)==''){
        $error['deskripzioa']="Deskripzioa ezin da hutsik egon.";
        $errores=true;
    } elseif(!testuaDa($deskripzioa)){
        $error['deskripzioa']="Testuaren formatua gaizki dago.";
        $errores=true;
    } 

    if (str_replace(' ','',escape($_POST['salneurria']))!='') {
        $salneurria = $_POST['salneurria'];
        if(!is_numeric(escape($salneurria))){
            $error['salneurria']="Zenbaki bat izan behar da.";
            $errores=true;
        }
    }

    if(!$errores){
        echo $salneurria;
        mysqli_query($conx,"UPDATE produktuak SET deskripzioa = '".$deskripzioa."', salneurria = ".$salneurria." WHERE ID = ".$_GET['pic_id']);
        header("Location: ".$_SERVER['PHP_SELF']);

    }
  
}

?>

<div align=center>
    <fieldset style=width:300;>
    <legend><b>Descripción</b></legend>
    <br>
    <?php

        $picquery = mysqli_query($conx,"SELECT * FROM produktuak WHERE ID = ".$_GET['pic_id']);
        $data = mysqli_fetch_array($picquery);

        echo "<h4>".$data['izena']." - ".$data['salneurria']."€</h4>";
        echo "<img src=images/".$data['pic']." border=1><br>";

    ?>
    <br>
    <form action="<?php echo $_SERVER['PHP_SELF']."?action=description&pic_id=".$_GET['pic_id']."&postdescription=1";?>" method=POST>
        <h5>Deskripzioa:</h5>
        <textarea name=deskripzioa cols=50 rows=10>
            <?php
            echo $data['deskripzioa'];
            ?>
        </textarea><br>
        <?php if ($error['deskripzioa']) echo "<p style='color:red'>" . $error['deskripzioa'] . "</p>"; ?>
        <br>
        Salneurri berria: <input type="number" name="salneurria">
        <?php if ($error['salneurria']) echo "<p style='color:red'>" . $error['salneurria'] . "</p>"; ?>
        <br>
        <br>
        <input type=submit value="Aldatu">
    </form>
    </fieldset>
</div>