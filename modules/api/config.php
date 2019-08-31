<?php


return [
    'components' => [
        'request' => [
            "class" => "\yii\web\Request",
            'cookieValidationKey' => 'MTaXOAfiANsxh4OfL7wHxgXKaOOZ7BWK',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            "class" => "\yii\web\UrlManager",
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ["class" => 'yii\rest\UrlRule', "controller" => ["api/user"]]
                ],
            ],

        ],
        'params' => [
            // список параметров
        ],
    ];