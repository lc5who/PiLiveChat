<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::get('/test', [\App\Controller\IndexController::class, 'test']);
Router::get('/mock/test', [\App\Controller\IndexController::class, 'test']);
Router::post('/login', [\App\Controller\UserController::class, 'login']);

Router::addGroup('/v1', function () {
    Router::get('/test', [\App\Controller\UserController::class, 'test']);
},['middleware'=>[\Qbhy\HyperfAuth\AuthMiddleware::class]]);

//前台接口
