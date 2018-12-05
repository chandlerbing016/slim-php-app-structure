<?php

return array(
    'settings' => array(
        'displayErrorDetails' => true,
        'doctrine' => array(
            'dev_mode' => true,
            'cache_dir' => KIRK_BASE_ROOT . 'var/cache/doctrine',
            'metadata_dirs' => [KIRK_BASE_ROOT . 'src/Kirk/Entities'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'resource',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
        ),
    ),
);
