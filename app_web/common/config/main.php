<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'pgsql:host=postgres;port=5432;dbname=' . getenv('POSTGRES_DB'),
            'username' => getenv('POSTGRES_USER'),
            'password' => getenv('POSTGRES_PASSWORD'),
        ],
        'cache' => [
            'class' => \yii\redis\Cache::class,
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis',
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
            ],
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
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => require __DIR__ . '/oauth-clients.php',
        ],
    ],
];
