<?php
return [

    'providers' => [
        \core\soft\container\providers\webProvider::class,
    ],

    'components_init' => [],
    'components' => [
        'request' => [
            'class' => \core\soft\request\Request::class,
            'mode' => 1,
            'home' => 'home/index',
            'parses' => [
                'multipart/form-data' => \core\soft\request\multipart\FormData::class
            ]
        ],
        'router' => [
            'class' => \core\soft\router\Router::class,
        ]
    ],
];
