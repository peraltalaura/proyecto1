<?php

    use PHPUnit\Framework\TestCase;
    use App\includes\funtzioak;

    class CalculatorTest extends TestCase {

        function escape($html) {
            $htmlsanitizado=htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
            $htmlsanitizado=strip_tags($html);
            return $htmlsanitizado;
        }
    }

?>