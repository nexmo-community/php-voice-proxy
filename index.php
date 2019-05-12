<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';

/* Your Nexmo number. Inbound calls will appear to come from this number. */
define(FROM_NUMBER, '');

/* The number you want to call */
define(TO_NUMBER, '');

$app = new \Slim\App;
$app->get('/webhooks/answer', function (Request $request, Response $response) {

    $ncco = [
        [
            'action' => 'connect',
            'from' => FROM_NUMBER,
            'endpoint' => [
                [
                    'type' => 'phone',
                    'number' => TO_NUMBER,
                ],
            ],
        ],
    ];
    return $response->withJson($ncco);
});

$app->post('/webhooks/events', function (Request $request, Response $response) {
    error_log($request->getBody());
});

$app->run();
