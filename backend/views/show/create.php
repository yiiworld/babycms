<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Show */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Show',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrTpl' => $arrTpl,
    ]) ?>

</div>
