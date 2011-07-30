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

// Twig
$app->register(new Silex\Extension\TwigExtension(), array(
    'twig.path'       => __DIR__.'/../views',
    'twig.class_path' => __DIR__.'/../vendor/twig/lib',
));
$app['twig']->addFilter('nl2br', new Twig_Filter_Function('nl2br', array('is_safe' => array('html'))));

// 一覧表示
$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM Posts";
    $posts = $app['db']->fetchAll($sql);
    return $app['twig']->render('index.twig.html', array('posts' => $posts));
});

// 詳細表示
$app->get('/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM Posts WHERE id = ?";
    $post = $app['db']->fetchAssoc($sql, array((int) $id));
    return $app['twig']->render('view.twig.html', array('post' => $post));
});

// アプリケーションのインスタンスを返す
return $app;