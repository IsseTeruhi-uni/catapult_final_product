<?php

use Illuminate\Routing\Router;


Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('companies', CompanyController::class);
    $router->resource('groups', GroupController::class);
    $router->resource('posts', PostController::class);
    $router->resource('skills', SkillController::class);
    $router->resource('hobbies', HobbyController::class);
    $router->resource('tweets', TweetController::class);
    $router->resource('blogs', BlogController::class);
    $router->resource('meetings', MeetingController::class);
});
