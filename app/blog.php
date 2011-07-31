<?php
// blog.php
require_once __DIR__.'/../silex.phar';

$app = new Silex\Application();
$app['debug'] = true;

// DB
$app->register(new Silex\Extension\DoctrineExtension(), array(
    'db.options'            => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
		'dbname'	=> 'blog',
		'user'		=> 'ichikawa',
		'password'	=> 'hogehoge'
    ),
    'db.dbal.class_path'    => __DIR__.'/../vendor/doctrine-dbal/lib',
    'db.common.class_path'  => __DIR__.'/../vendor/doctrine-common/lib',
));

// 一覧表示
$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM Posts";
    $posts = $app['db']->fetchAll($sql);
    ob_start();
    require __DIR__ . '/../views/index.php';
    return ob_get_clean();
});

// 詳細表示
$app->get('/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM Posts WHERE id = ?";
    $post = $app['db']->fetchAssoc($sql, array((int) $id));
    ob_start();
    include __DIR__ . '/../views/view.php';
    return ob_get_clean();
});

// アプリケーションのインスタンスを返す
return $app;