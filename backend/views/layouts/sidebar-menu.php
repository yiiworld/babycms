<?php
use common\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'label' => Yii::t('app', 'Catalog'),
                'url' => ['/catalog'],
                'icon' => 'fa-group'
            ],
            [
                'label' => Yii::t('app', 'Show'),
                'url' => ['/show'],
                'icon' => 'fa-book'
            ]
        ]
    ]
);