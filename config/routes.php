<?php

$routes = [
    '/' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/addsell' => [
        'controller' => 'table',
        'action' => 'addSell'
    ],
    '/table' => [
        'controller' => 'table',
        'action' => 'showTable'
    ],
    '/show' => [
        'controller' => 'index',
        'action' => 'show'
    ],
    '/hello' => [
        'controller' => 'helloWorld',
        'action' => 'hello'
    ],
    '/world' => [
        'controller' => 'helloWorld',
        'action' => 'world'
    ],
];
