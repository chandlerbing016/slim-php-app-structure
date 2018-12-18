<?php

namespace Kirk\Middlewares;


abstract class AbstractMW
{
    public function __construct($container)
    {
        $this->container = $container;
    }
}