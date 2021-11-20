<?php

$routes = [
    '/' => [
        'controller' => 'index',
        'action' => 'index'
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

    '/create/form' => [
        'controller' => 'index',
        'action' => 'createForm'
    ],

    '/create' => [
        'controller' => 'index',
        'action' => 'create'

    ]
];
