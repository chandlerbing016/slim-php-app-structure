<?php
namespace Kirk\Middlewares;

use Kirk\Middlewares\AbstractMW;

use Kirk\Lib\Auth;

class RequestMW extends AbstractMW
{
    public function __invoke($request, $response, $next)
    {
        if(Auth::ifUser())
        {   
            $request = $request->withAttribute('logged_in_user', Auth::getUser());
        }

        return $next($request, $response);
    }
}