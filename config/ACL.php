<?php

/**
* @return array With Access Control List
*/
return [
    'Dashboard' => [
        'owner',
        'admin',
        'employee'
    ],
    'Reports' => [
        'owner',
        'employee'
    ],
    'Configuration' => [
        'owner',
        'admin'
    ],
    'Register' => [
        'owner'
    ]
];
