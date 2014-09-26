<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Html::encode(($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::$app->name);
$this->registerMetaTag(['name' => 'keywords', 'content' => Html::encode($catalog->seo_keywords ? $catalog->seo_keywords : $catalog->seo_keywords)]);
$this->registerMetaTag(['name' => 'description', 'content' => Html::encode($catalog->seo_description ? $catalog->seo_description : $catalog->seo_description)]);
$this->params['breadcrumbs'][] = Html::encode($catalog->title);
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
        </div>
    </div>

</div>

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
                <h1><?php echo Yii::t('common', 'contact'); ?></h1>
                <div id='contact_content'><?php echo 'aa'; ?></div>
            </div>
        <?php } ?>
    </div>

    <div id="main_right" class="span-18 last">
        <h3><span><?php echo $catalog->title; ?></span></h3>
        <div class="clear"></div>

        <div class="main_content">
            <?php echo $catalog->content; ?>
        </div>

    </div>

</div>
