<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);

$menuItemsMain = [
    ['label' => 'Catalog', 'url' => ['/catalog']],
    ['label' => 'Show', 'url' => ['/show']],
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $menuItemsMain,
    'encodeLabels' => false,
]);

NavBar::end();

