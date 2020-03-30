<?php
return [
    'components_init' => [],
    'components' => [
        'request' => [
            'class' => \core\components\request\Request::class,
            'mode' => 1,
            'home' => 'home/index',
            'parses' => [
                'multipart/form-data' => \core\components\request\multipart\FormData::class
            ]
        ],
        'router' => [
            'class' => \core\components\router\Router::class,
        ]
    ]
];
