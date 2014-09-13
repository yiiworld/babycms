<?php

use yii\helpers\Html;
use common\components\F;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Catalogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Catalog',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>排序</th>
            <th>类型</th>
            <th>顶级目录</th>
            <th>状态</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($dataProvider as $item){ ?>
        <tr data-key="1">
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['str_label']; ?></td>
            <td><?php echo $item['sort_order']; ?></td>
            <td><?php echo F::getPageType($item['page_type']); ?></td>
            <td><?php echo F::getYesNo($item['is_nav']); ?></td>
            <td><?php echo F::getStatus2($item['status']); ?></td>
            <td>
                <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['catalog/create','parent_id'=>$item['id']]); ?>" title="增加子栏目" data-pjax="0"><span class="glyphicon glyphicon-plus-sign"></span></a>
                <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['catalog/view','id'=>$item['id']]); ?>"" title="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['catalog/update','id'=>$item['id']]); ?>"" title="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['catalog/delete','id'=>$item['id']]); ?>"" title="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
