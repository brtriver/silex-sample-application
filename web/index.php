<?PHP
$blog = require __DIR__.'/../app/blog.php';

$app = new Silex\Application();
$app->mount('/blog', $blog);

// 中心となるアプリケーションを定義

$app->run();