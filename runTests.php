<?php
function run_remote_test($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "cqTest", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);

    return $content;
}
error_reporting(E_ALL);
if(!empty($argv[1]) && strtolower(substr($argv[1], 0, 4)) == 'test') {
    $files = array($argv[1]);
} else {
    $files = scandir(__DIR__ . '/../');
}
$passed = 0;
$errors = 0;
$executed = array();
foreach($files as $file) {
    if(strtolower(substr($file, 0, 4)) == 'test' && substr($file, -4, 4) == '.php') {
        $url = $argv[2] . '/' . $argv[3] . '/tests/' . $file;
        $executed[] = $url;
        $output = run_remote_test($url);
        if(strlen($output) > 0) {
            echo $output;
            $errors++;
        } else {
            $passed++;
        }
    }
}
$NC = "\e[0m";
$RED = "\e[0;31m";
$GRN = "\e[0;32m";
$CYN = "\e[0;36m";
$REDB = "\e[41m";
echo count($executed) . ' testes executados:' . PHP_EOL;
foreach($executed as $file) {
    echo ' - ' . $file . PHP_EOL;
}
if($errors > 0) {
    echo $RED . $errors . ' ERROS; ';
}
echo $GRN . $passed . ' OK. ' . PHP_EOL;
?>