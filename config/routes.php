<?php

use Slim\App;
use Nyholm\Psr7\ServerRequest;
use Nyholm\Psr7\Response;


return function (App $app) {

    $app->get('/', function (ServerRequest $request, Response $response) {
        $response->getBody()->write("Hello world!");
        return $response;
    });

};