<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Html::encode(($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::$app->name);
$this->registerMetaTag(['name' => 'keywords', 'content' => Html::encode($catalog->seo_keywords ? $catalog->seo_keywords : $catalog->seo_keywords)]);
$this->registerMetaTag(['name' => 'description', 'content' => Html::encode($catalog->seo_description ? $catalog->seo_description : $catalog->seo_description)]);
$this->params['breadcrumbs'][] = Html::encode($catalog->title);
?>

<?php if($catalog->banner) { ?>
    <div id="banner">
        <img src="<?php echo $catalog->banner; ?>">
    </div>
<?php } ?>

<div id="main" class="container">

    <div id='main_left' class="span-6">
        <?php if(count($portlet) > 1) { ?>
            <div id='portlet'>
                <h1><?php echo $portletTitle; ?></h1>
                <ul>
                    <?php
                    foreach($portlet as $item)
                    {
                        $url = Yii::$app->getUrlManager()->createUrl(['/site/'.$item->page_type, 'id'=>$item->id]);
                        echo ($catalog->id == $item->id) ? '<li class="active"><a href="'.$url.'">'.$item->title.'</a></li>' : '<li><a href="'.$url.'">'.$item->title.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>

        <?php if(true) { ?>
            <div id='contact'>
                <h1><?php echo Yii::t('app', 'contact'); ?></h1>
                <div id='contact_content'><?php echo 'a'; ?></div>
            </div>
        <?php } ?>
    </div>

    <div id="main_right" class="span-18 last">
        <h3><span><?php echo $catalog->title; ?></span></h3>
        <div class="clear"></div>

        <div class="main_list">
            <ul>
                <?php
                foreach($show as $item)
                {
                    $url = (strlen($item->redirect_url) > 5) ? $item->redirect_url : Yii::$app->getUrlManager()->createUrl(['/site/show', 'id'=>$item->id]);
                    echo '<li><span>'.date('Y年m月d日',strtotime($item->create_time)).'</span><a href="'.$url.'" target="_blank">'.$item->title.'</a></li>';
                }
                ?>
            </ul>
            <div class="clear"></div>
            <div id="pager">
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>
    </div>

</div>
