<?php

include "docker-compose/conf.php";
include "docker-compose/includes/mysql.php";

$creds = mysqli_query($conx,"SELECT * FROM users WHERE username='". $username ."'");

$creds = mysqli_fetch_array($creds);

?>