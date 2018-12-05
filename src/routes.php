<?php

# App's APIs
$app->group('/api', function() {



});

# App's ROUTEs
$app->map(['GET'], '/', 'Kirk\Controllers\HomeController:index');