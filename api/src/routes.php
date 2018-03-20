<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Routes
// Grupo de rutas para el API
$app->group('/api', function () use ($app) {
    // Version group
    $app->group('/v1', function () use ($app) {
        $app->get('/typeShips', 'getTypeShip');
        $app->get('/rebelShips', 'getShips');
        $app->post('/add', 'registerSpaceship');
        $app->post('/access', 'accesPlataform');
        $app->post('/platform', 'getAuthorization');
        $app->get('/ship/{search}', 'searchShip');
    });
});