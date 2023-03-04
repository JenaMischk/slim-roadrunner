<?php

use Slim\App;


return function (App $app) {

    $app->get('/fds', function (Nyholm\Psr7\ServerRequest $request, Nyholm\Psr7\Response $response) {
        $response->getBody()->write("Hello Slim world!");
        return $response;
    });

};