<?php

    include("conf.php");
    include("includes/mysql.php");
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