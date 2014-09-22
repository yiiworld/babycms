<?php
return [
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@yii/messages",
                    'sourceLanguage' => 'zh',
                    'fileMap' => [
                        'yii'=>'yii.php',
                        'authorization'=>'authorization.php',
                        'app'=>'app.php',
                    ]
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'zh',
                ],
            ]
        ],
    ],
];
