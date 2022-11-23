<?php

    use PHPUnit\Framework\TestCase;
    use App\includes\funtzioak;

    class Test extends TestCase {

        public function testsanitizar() {
            $html="<script>alert('test')</script>";
            $htmlsanitizado=htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
            $htmlsanitizado=strip_tags($html);
            $this->assertEquals($htmlsanitizado, "alert('test')");
        }

        public function testirudiaDa(){
            $irudia="imagen.jpg";
            $allowed=array('jpg','png');
            $ext=pathinfo($irudia,PATHINFO_EXTENSION);
            $resultado=false;
            if(!in_array($ext,$allowed)){
                $resultado=true;
            }
            
            $this->assertEquals($resultado, false);
        }

        public function testtestuaDa(){
            $nombres="/^[a-zA-ZñáéíóúÁÉÍÓÚäëïöüÄËÏÖÜ\s]+$/";
            $testua="abcdse7847aldfjla";
            $resultado=false;
            if(!preg_match($nombres,$testua)){
                $resultado= true;
            }
    
            $this->assertEquals($resultado, true);
        }
    }

?>