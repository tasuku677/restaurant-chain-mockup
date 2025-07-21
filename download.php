<?php

require_once 'vendor/autoload.php';
// require_once 'Interfaces/FileConvertible.php';
// require_once 'Models/User.php';
// require_once 'Models/Employee.php';
// require_once 'Helpers/RandomGenerator.php';

// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register(function($class){
    $base_dir = __DIR__. '/';
    $file = $base_dir.str_replace('\\', '/', $class). '.php';
    if(file_exists($file)){
        require_once $file;
    }
});
use Helpers\RandomGenerator;


$count = $_POST['restaurant_count'];
$format = $_POST['format'];

// パラメータが正しい形式であることを確認
$count = (int)$count;

if(is_null($count) || is_null($format)){
    exit('Missing parameters.');
}

if(!is_numeric($count) || $count < 1 || $count > 100){
    exit('Invalid count. Must be a number between 1 and 100.');
}
$allowedFormats = ['html', 'markdown', 'json', 'txt'];
if(!in_array($format, $allowedFormats)){
    exit('Invalid type. Must be one of:' . implode(', ', $allowedFormats));
}

$restaurantChains = RandomGenerator::restaurantChains($count, $count);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="restaurant$restaurantChains.md"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurant$restaurantChains.json"');
    $restaurantChainsArray = array_map(fn($restaurantChain) => $restaurantChain->toArray(), $restaurantChains);
    echo json_encode($restaurantChainsArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="restaurant$restaurantChains.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toHTML();
    }
}
?>