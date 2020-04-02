<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\redis\Cache::class,
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis',
        ],
        'rabbitmq' => [
            'class' => \mikemadisonweb\rabbitmq\Configuration::class,
            'connections' => [
                [
                    'host' => 'rabbitmq',
                    'port' => '5672',
                    'user' => getenv('RABBITMQ_DEFAULT_USER'),
                    'password' => getenv('RABBITMQ_DEFAULT_PASSWORD'),
                    'vhost' => '/',
                ]
            ],
        ],
    ],
];
