<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register(function($class){
    $base_dir = __DIR__. '/';
    $file = $base_dir.str_replace('\\', '/', $class). '.php';
    if(file_exists($file)){
        require_once $file;
    }
});


// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

// ユーザーの生成
$users = RandomGenerator::users($min, $max);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Chain</title>
    <style>
    </style>
</head>
<body>
    <h1><?php echo sprintf("Restaurant Chain %s %s %s", )?></h1>
    <?php foreach ($users as $user):
        echo $user->toHTML();
    endforeach; ?> 

</body>
</html>