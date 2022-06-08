<?php
  require_once __DIR__ . '/cqTester/cqTest.php';

  class Exemplo {
    
    private $titulo;
    
    public function setTitulo($str) {
      $this->titulo = $str;
    }

    public function isValido() {
      if (empty($this->titulo)) {
        return false;
      }
      return true;
    }
  }

  class Test_Exemplo extends cqTest {

    static function setup() {
        // Prepare o ambiente para que o teste consiga executar
        // Requeira scripts, preencha variáveis de seção, etc
    }

    static function mockUpExemplo($titulo) {
        $obj = new Exemplo;
        $obj->setTitulo($titulo);
        return $obj;
    }

    static function testExemploValido() {
        $obj = self::mockUpExemplo('Teste');
        assert($obj->isValido() === true, 'O exemplo deveria ser válido pois possui todos dados necessários');
    }
    
    static function testExemploInvalido() {
        $obj = self::mockUpExemplo('Teste');
        assert($obj->isValido() === false, 'O exemplo deveria ser invalido pois é necessária uma descrição válida');
    }
    
  }
  Test_Exemplo::run();
?>
