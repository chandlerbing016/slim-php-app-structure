<?php

namespace Kirk\Core;

use Interop\Container\ContainerInterface as Container;
use Doctrine\ORM\EntityManager;

class Controller
{
    protected $view;

    protected $em;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        $this->em = $container->get(EntityManager::class);
    }
}
