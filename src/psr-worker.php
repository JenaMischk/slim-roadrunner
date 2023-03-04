<?php

declare(strict_types=1);

include 'vendor/autoload.php';

// Instantiate DI container with Roadrunner support
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions('config/container.php');
$container = $containerBuilder->build();

// Instantiate Slim app
$app = DI\Bridge\Slim\Bridge::create($container);

// Register routes
(require 'config\routes.php')($app);

// Register middleware
(require 'config\middleware.php')($app);


$psr7 = $app->getContainer()->get(\Spiral\RoadRunner\Http\PSR7WorkerInterface::class);

while(true){

    try {

        $req = $psr7->waitRequest();
        $res = $app->handle($req);
    
        if (!($req instanceof \Psr\Http\Message\ServerRequestInterface)) { // Termination request received
            break;
        }

    } catch (\Throwable) {
        $psr7->respond(new Nyholm\Psr7\Response(400)); // Bad Request
        continue;
    }

    try {
        $psr7->respond($res);
    } catch (\Throwable) {
        $psr7->respond(new Nyholm\Psr7\Response(500, [], 'Something Went Wrong!'));
    }

}