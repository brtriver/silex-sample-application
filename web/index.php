<?PHP
$blog = require __DIR__.'/../app/blog.php';

$app = new Silex\Application();
$app->mount('/blog', $blog);


// cache
$app->register(new Silex\Extension\HttpCacheExtension(), array(
    'http_cache.cache_dir' => __DIR__.'/../cache/',
));

// 中心となるアプリケーションを定義

$app['http_cache']->run();