<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST registo' => 'registo',
                        'POST login' => 'login',
                        'PUT editar/{username}' => 'editar',
                        'GET detalhes/{id}' => 'detalhes',
                        'PATCH apagar/{username}' => 'apagar',
                    ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>',
                            '{username}' => '<username:.*?>',
                        ],
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/produto',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET pesquisa/{pesquisa}' => 'pesquisa'


                    ],
                    'tokens' =>
                        [
                        ],
                ],
            ],
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '../../backend/web/imagens',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];



