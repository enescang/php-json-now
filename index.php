<?php
//header('Content-Type: application/json');
require('JsonNow.php');
$conf=[
    'prop'=>[
        'id',
        'name',
        'age',
    ],
    'settings'=>[
        'minAge'=>1,
        'maxAge'=>10,
    ]

    
];

$t = JSONX::size(100)->config($conf)->json();
echo $t;
