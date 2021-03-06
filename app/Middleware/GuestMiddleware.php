<?php

namespace App\Middleware;

class GuestMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if($this->container->auth->check()){
            $this->container->flash->addMessage('warning','You are already signed in!');
            return $response->withRedirect($this->container->router->pathFor('tasks'));
        }
        $response = $next($request, $response);
        return $response;
    }
}