<?php
  require_once __DIR__ . '/cqTester/cqTest.php';
  class Test_Exemplo extends cqTest {

    static function setup() {
        user::logIn('username', 'password');
        require_once __DIR__ . '/../src/Exemplo.php';
    }

    static function mockUpExemplo($titulo, $descricao) {
        $obj = new Exemplo;
        $obj->setTitulo($titulo);
        $obj->setDescricao($descricao);
        return $obj;
    }

    static function testExemploValido() {
        $obj = self::mockUpExemplo('Teste', 'Testando');
        assert($obj->isValido() === true, 'O exemplo deveria ser válido pois possui todos dados necessários');
    }
    
    static function testExemploInvalido() {
        $obj = self::mockUpExemplo('Teste', '');
        assert($obj->isValido() === false; 'O exemplo deveria ser invalido pois é necessária uma descrição válida');
    }
    
  }
  Test_Exemplo::run();
?>
