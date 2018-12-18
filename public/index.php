<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/defines.php';

session_start();

$settings = require __DIR__ . '/../config/settings.php';
$container = new \Slim\Container($settings);
$app = new \Slim\App($container);

require __DIR__ . '/../src/container.php';

require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/routes.php';

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

$app->run();
