<?php
namespace Kirk\Middlewares;

use Kirk\Middlewares\AbstractMW;

class UserMW extends AbstractMW
{
    public function __invoke($request, $response, $next)
    {
        if ($request->getAttribute('logged_in_user') != null) {
            return $next($request, $response);
        }

        return $response->withRedirect('/g/login', 301);
    }
}
