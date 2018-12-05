<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

define('KIRK_BASE_ROOT', dirname(__FILE__) . '/');

$settings = require dirname(__FILE__) . '/config/settings.php';

$entityManager = function () use($settings): EntityManager {
    $config = Setup::createAnnotationMetadataConfiguration(
        $settings['settings']['doctrine']['metadata_dirs'],
        $settings['settings']['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new AnnotationDriver(
            new AnnotationReader,
            $settings['settings']['doctrine']['metadata_dirs']
        )
    );

    $config->setMetadataCacheImpl(
        new FilesystemCache(
            $settings['settings']['doctrine']['cache_dir']
        )
    );

    return EntityManager::create(
        $settings['settings']['doctrine']['connection'],
        $config
    );
};

ConsoleRunner::run(
    ConsoleRunner::createHelperSet($entityManager())
);
