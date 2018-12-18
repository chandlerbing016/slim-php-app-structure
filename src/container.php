<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

# entity manager
$container[EntityManager::class] = function ($container): EntityManager {
    $config = Setup::createAnnotationMetadataConfiguration(
        $container['settings']['doctrine']['metadata_dirs'],
        $container['settings']['doctrine']['dev_mode']
    );
    $config->setMetadataDriverImpl(
        new AnnotationDriver(
            new AnnotationReader,
            $container['settings']['doctrine']['metadata_dirs']
        )
    );
    $config->setMetadataCacheImpl(
        new FilesystemCache(
            $container['settings']['doctrine']['cache_dir']
        )
    );
    $EntityManager =  EntityManager::create(
        $container['settings']['doctrine']['connection'],
        $config
    );
    $EntityManager->getConnection()->getConfiguration()->setSQLLogger(null);
    return $EntityManager;
};

# twig view
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(KIRK_BASE_ROOT . 'resources/views', [
        'debug' => true,
        'cache' => false,
    ]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));
    $view->addExtension(new \Twig_Extension_Debug());
    return $view;
};

# repositories
$container['UserRepository'] = function ($container) {
    return new \Kirk\Repositories\UserRepository($container[EntityManager::class]);
};

$container['PostRepository'] = function ($container) {
    return new \Kirk\Repositories\PostRepository($container[EntityManager::class]);
};

