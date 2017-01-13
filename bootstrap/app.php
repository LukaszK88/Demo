<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:18
 */

use Respect\Validation\Validator as v;

session_start();

require __DIR__.'/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'demo',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule){
    return $capsule;
};


$container['flash'] = function($container){
    return new \Slim\Flash\Messages();
};


$container['view'] = function($container){
    $view = new\Slim\Views\Twig(__DIR__.'/../resources/views',[
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('flash',$container->flash);


    return $view;
};

$container['validator'] = function($container){
    return new Demo\Validation\Validator;
};

$container['HomeController'] = function($container){
    return new \Demo\Controllers\HomeController($container);
};

$container['UserController'] = function($container){
    return new \Demo\Controllers\UserController($container);
};

$container['csrf'] = function($container){
    return new \Slim\Csrf\Guard;
};

$app->add(new \Demo\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \Demo\Middleware\OldInputMiddleware($container));
$app->add(new \Demo\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('Demo\\Validation\\Rules');

require __DIR__.'/../app/routes.php';


