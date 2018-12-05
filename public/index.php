<?php


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
