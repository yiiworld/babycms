<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Catalog;
use common\components\F;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Show */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('/babycms/backend/web/libs/kindeditor/themes/default/default.css');
$this->registerJsFile('/babycms/backend/web/libs/kindeditor/kindeditor-min.js');
$this->registerJsFile('/babycms/backend/web/libs/kindeditor/lang/zh_CN.js');
$js=<<<JS
                        var editor;
                        KindEditor.ready(function(K) {
                                editor = K.create('textarea[name="content"]', {
                                        allowFileManager : true
                                });
                        });
JS;
$this->registerJs($js,View::POS_END);
?>

<div class="show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(ArrayHelper::map(Catalog::get(0, Catalog::find()->all()), 'id', 'str_label')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'brief')->textInput(['maxlength' => 1022]) ?>

    <?= $form->field($model, 'content')->textArea(['name'=>'content','style'=>'width:800px;height:400px;visibility:hidden;']) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => 1022]) ?>

    <?= $form->field($model, 'banner')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'template')->dropDownList($arrTpl['show']) ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'click')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->dropDownList(F::getStatus2()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
