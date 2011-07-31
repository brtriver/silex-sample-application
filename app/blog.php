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

// Twig
$app->register(new Silex\Extension\TwigExtension(), array(
    'twig.path'       => __DIR__.'/../views',
    'twig.class_path' => __DIR__.'/../vendor/twig/lib',
    'twig.options' => array('cache' => __DIR__.'/../cache'),
));
$app['twig']->addFilter('nl2br', new Twig_Filter_Function('nl2br', array('is_safe' => array('html'))));

// 一覧表示
$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM Posts";
    $sth = $app['pdo']->prepare($sql);
    $sth->execute();
    $posts = $sth->fetchAll();
    return $app['twig']->render('index.twig.html', array('posts' => $posts));
});

// 詳細表示
$app->get('/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM Posts WHERE id = ?";
    $sth = $app['pdo']->prepare($sql);
    $sth->execute(array((int)$id));
    $post = $sth->fetch();
    return $app['twig']->render('view.twig.html', array('post' => $post));
});

// アプリケーションのインスタンスを返す
return $app;