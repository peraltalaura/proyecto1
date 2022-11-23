<?php

    include "../docker-compose/www/includes/funtzioak.php";

    if(userExists("admin@bdweb")){
        echo "Konexioa ondo";
    } else {
        echo "Ez dago konexiorik";
    }

?>