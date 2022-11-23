<?php

    use PHPUnit\Framework\TestCase;
    use App\includes\funtzioak;

    class Test extends TestCase {

        public function testsanitizar():void {
            $html="<script>alert('test')</script>";
            $htmlsanitizado=htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
            $htmlsanitizado=strip_tags($html);
            $this->assertEquals($htmlsanitizado, "alert('test')");
        }
    }

?>