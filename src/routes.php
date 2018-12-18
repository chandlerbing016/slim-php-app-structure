<?php

# common routes
$app->map(['GET'], '/', 'Kirk\Controllers\HomeController:index')
    ->setName('home');

$app->map(['GET'], '/v/post/{id:[0-9]+}', 'Kirk\Controllers\PostController:viewone')
    ->setName('n.post');

# guest only requests
$app->group('/g', function () {

    $this->map(['GET', 'POST'], '/login', 'Kirk\Controllers\Auth\SignupController:login')
        ->setName('g.login');

    $this->map(['POST'], '/signup', 'Kirk\Controllers\Auth\SignupController:signup')
        ->setName('g.signup');

})->add(Kirk\Middlewares\GuestMW::class);

# user only requests
$app->group('/u', function () {

    $this->map(['GET', 'POST'], '/n/post', 'Kirk\Controllers\PostController:index')
        ->setName('u.n.post');

    $this->map(['GET'], '/posts', 'Kirk\Controllers\UserController:showallposts')
        ->setName('u.posts');

    $this->map(['GET'], '/settings', 'Kirk\Controllers\SettingsController:index')
        ->setName('u.settings');

    $this->map(['GET'], '/logout', 'Kirk\Controllers\Auth\SignupController:logout')
        ->setName('u.logout');

})->add(Kirk\Middlewares\UserMW::class);
