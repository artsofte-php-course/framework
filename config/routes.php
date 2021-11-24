<?php

$routes = [
    '/' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/contracts' => [
        'controller' => 'contracts',
        'action' => 'showContracts'
    ],
    '/addcontract' => [
        'controller' => 'contracts',
        'action' => 'showContractsForm'
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
    ]
];
