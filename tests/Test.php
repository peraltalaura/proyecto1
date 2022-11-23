<?php

    use PHPUnit\Framework\TestCase;

    //MySQL
    $mysql_host = "mysql";
    $mysql_user = "root";
    $mysql_pass = "admin";
    $mysql_db = "bdweb";

    $conx = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
    mysqli_select_db($conx, $mysql_db);

    $creds = mysqli_query($conx,"SELECT * FROM users");

    $creds = mysqli_fetch_array($creds);

    $s = '<table border="1">';
    foreach ($creds as $cred) {
        $s .= '<tr>';
        foreach ( $cred as $c ) {
                $s .= '<td>'.$c.'</td>';
        }
        $s .= '</tr>';
    }
    $s .= '</table>';
    echo $s;

?>