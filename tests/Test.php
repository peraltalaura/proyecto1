<?php

    use PHPUnit\Framework\TestCase;
    use App\includes\funtzioak;

    $string_mal="<script>alert('hola')</script>";
    $string_sanitizada=escape($string_mal);

    echo $string_mal;
    echo $string_sanitizada;

?>