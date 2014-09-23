<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Show */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Show',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="show-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrTpl' => $arrTpl,
    ]) ?>

</div>
