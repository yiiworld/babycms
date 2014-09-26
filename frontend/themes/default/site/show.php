<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = Html::encode(($show->seo_title ? $show->seo_title : $show->title) . ' - ' . Yii::$app->name);
$this->registerMetaTag(['name' => 'keywords', 'content' => Html::encode($show->seo_keywords ? $show->seo_keywords : $catalog->seo_keywords)]);
$this->registerMetaTag(['name' => 'description', 'content' => Html::encode($show->seo_description ? $show->seo_description : $catalog->seo_description)]);
$this->params['breadcrumbs'][] = Html::encode($show->title);
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
                        $url = $this->createUrl('/site/'.$item->page_type,array('id'=>$item->id));
                        echo ($catalog->id == $item->id) ? '<li class="active"><a href="'.$url.'">'.$item->title.'</a></li>' : '<li><a href="'.$url.'">'.$item->title.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>

        <?php if(true) { ?>
            <div id='contact'>
                <h1><?php echo Yii::t('common', 'contact'); ?></h1>
                <div id='contact_content'><?php echo 'aa'; ?></div>
            </div>
        <?php } ?>
    </div>

    <div id="main_right" class="span-18 last">
        <h3><span><?php echo $show->title; ?></span></h3>
        <div class="clear"></div>

        <div class="main_content">
            <?php echo $show->content; ?>
        </div>

    </div>

</div>