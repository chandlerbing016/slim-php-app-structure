<?php

# this class must intercept every request
$app->add(Kirk\Middlewares\RequestMW::class);