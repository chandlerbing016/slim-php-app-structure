<?php

namespace Kirk\Core;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface as Container;

class Controller
{
    protected $view;

    protected $em;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        $this->em = $container->get(EntityManager::class);
        $this->container = $container;
    }
    
    public function __call($name, $arguments)
    {
        $com = explode("_", $name);
        if (count($com) == 2) {
            switch ($com[0]) {
                case 'repo':
                    $repo = ucfirst($com[1]) . 'Repository';
                    if ($this->container->has($repo)) {
                        return $this->container->get($repo);
                    }
                    break;
            }
        }
        return false;
    }
}
