<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Catalog;
use common\components\F;
use yii\web\View;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Catalog */
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
$this->registerJs($js, View::POS_END);
?>

<div class="catalog-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}{hint}</div>\n<div class=\"col-lg-8\">abc{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::merge([0 => Yii::t('app', 'Root Catalog')], ArrayHelper::map(Catalog::get(0, Catalog::find()->all()), 'id', 'str_label'))) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255])->hint('test') ?>

    <?= $form->field($model, 'brief')->textInput(['maxlength' => 1022]) ?>

    <!--<?/*= $form->field($model, 'content')->widget(letyii\tinymce\Tinymce::className(), [
        'options' => [
            'id' => 'content',
        ],
        'configs' => [ // Read more: http://www.tinymce.com/wiki.php/Configuration
            /*'link_list' => [
                [
                    'title' => 'My page 1',
                    'value' => 'http://www.tinymce.com',
                ],
                [
                    'title' => 'My page 2',
                    'value' => 'http://www.tinymce.com',
                ],
            ],*/
            /*'toolbar' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
        ],
    ]) */?>-->

    <!--<?/*= $form->field($model, 'content')->widget(dosamigos\tinymce\TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'zh_CN',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste image"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image",
            'file_browser_callback'=> new yii\web\JsExpression("function(field_name, url, type, win) {
                if(type=='image') $('#my_form input').click();
            }"),
        ]
    ]);*/?>-->
    <!--iframe id="form_target" name="form_target" style="display:none">
        <form id="my_form" action="/upload/" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input name="image" type="file" onchange="$('#my_form').submit();this.value='';">
        </form>
    </iframe>-->

    <?= $form->field($model, 'content')->textArea(['name'=>'content','style'=>'width:800px;height:400px;visibility:hidden;']) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => 1022]) ?>

    <?= $form->field($model, 'banner', [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n",
    ])->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'file', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->fileInput() ?>

    <?= $form->field($model, 'is_nav')->dropDownList(F::getYesNo()) ?>

    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'page_type')->dropDownList(F::getPageType()) ?>

    <?= $form->field($model, 'page_size')->textInput() ?>

    <?= $form->field($model, 'template_list')->dropDownList($arrTpl['list']) ?>

    <?= $form->field($model, 'template_show')->dropDownList($arrTpl['show']) ?>

    <?= $form->field($model, 'template_page')->dropDownList($arrTpl['page']) ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'click')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->dropDownList(F::getStatus2()) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

