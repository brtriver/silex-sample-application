<?php
// blog.php
require_once __DIR__.'/../silex.phar';

$app = new Silex\Application();
$app['debug'] = true;

// DB
$app['pdo'] =$app->share(function(){
    $dsn = 'mysql:dbname=blog;host=localhost';
    $user = 'ichikawa';
    $password = 'hogehoge';
    return new PDO($dsn, $user, $password);
});

// 一覧表示
$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM Posts";
    $sth = $app['pdo']->prepare($sql);
    $sth->execute();
    $posts = $sth->fetchAll();
    ob_start();
    require __DIR__ . '/../views/index.php';
    return ob_get_clean();
});

// 詳細表示
$app->get('/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM Posts WHERE id = ?";
    $sth = $app['pdo']->prepare($sql);
    $sth->execute(array((int)$id));
    $post = $sth->fetch();
    ob_start();
    include __DIR__ . '/../views/view.php';
    return ob_get_clean();
});

// アプリケーションのインスタンスを返す
return $app;