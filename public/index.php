<?php

/**
 *  my-short-post prototype, version - 1.0
 *
 *  my-short-post is an internet service that allows users to create short posts
 *  others can read, like, comment on those posts
 */

require __DIR__ . '/../vendor/autoload.php';

session_start();

require __DIR__ . '/../config/defines.php';

$settings = require __DIR__ . '/../config/settings.php';
$container = new \Slim\Container($settings);
$app = new \Slim\App($container);

require __DIR__ . '/../src/container.php';

require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/routes.php';

$app->run();
