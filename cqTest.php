<?php
interface cqTestInterface {
    public static function run();
}

class cqTest implements cqTestInterface {
    
    /**
     * Método para ser sobrescrito, é executado sempre no início de run()
     * Se realizar qualquer saída ou atirar exceptions falhará o teste
     */
    protected static function setup() {
        // 
    }

    protected static function setErrorLevel() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    public static function run() {
        self::setErrorLevel();
        ob_start();
        $exception = false;
        try {
            static::setup();
        } catch(Exception $e) {
            $exception = $e;
        }
        $setup_output = ob_get_contents();
        self::setErrorLevel();
        if(strlen($setup_output) > 0) {
            echo new Exception('SETUP DO TESTE FALHOU: ' . $setup_output);
        }
        if($exception !== false) {
            echo 'SETUP DO TESTE FALHOU: ' . $exception;
        }
        ob_end_clean();
        assert_options(ASSERT_ACTIVE, 1);
        assert_options(ASSERT_WARNING, 0);
        assert_options(ASSERT_QUIET_EVAL, 1);
        assert_options(ASSERT_CALLBACK, array('self','assertHandler'));
        $self_methods = get_class_methods(__CLASS__);
        foreach(get_class_methods(get_called_class()) as $method) {
            if(in_array($method, $self_methods)) {
                continue;
            }
            if(substr($method, 0, 4) != 'test') {
                continue;
            }
            try {
                static::$method();
            } catch(Exception $e) {
                echo $e;
                //break;
            }
        }
        return true;
    }

    static function assertHandler($file, $line, $code, $description) {
        echo PHP_EOL . 'TESTE FALHOU: ' . $description . '; Arquivo: ' . $file . '(' . $line . '); Code: ' . $code . '. ' . PHP_EOL;
    }
}
?>