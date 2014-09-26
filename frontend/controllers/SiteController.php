<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Catalog;
use common\models\Show;
use yii\data\Pagination;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $mainMenu = [];
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action))
        {
            $this->mainMenu = array((array('label'=>Yii::t('common','Home'), 'url'=>array('/site/index'))));

            $theme = Yii::$app->params['template'];
            Yii::$app->view->theme = new \yii\base\Theme([
                'pathMap' => ['@frontend/views' => '@frontend/themes/' . $theme,],

            ]);

            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $rootId = ($id>0) ? Catalog::getRootCatalogId($id, Catalog::find()->all()) : 0;

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPage()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if(0 >= $id)
            $this->redirect(Yii::$app->homeUrl);

        $catalog = Catalog::findOne(['id' => $id]);
        $templatePage = $catalog->template_page ? $catalog->template_page : 'page';

        $portlet = Catalog::getCatalogSub2($id, Catalog::find()->all());
        $portletTitle = Catalog::findOne(['id' => Catalog::getRootCatalogId($id, Catalog::find()->all())])->title;

        return $this->render($templatePage, ['catalog'=>$catalog, 'portlet'=>$portlet, 'portletTitle'=>$portletTitle]);
    }

    public function actionList()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if(0 >= $id)
            $this->redirect(Yii::$app->homeUrl);

        $catalog = Catalog::findOne(['id' => $id]);
        $templatePage = $catalog->template_list ? $catalog->template_list : 'list';

        $portlet = Catalog::getCatalogSub2($id, Catalog::find()->all());
        $portletTitle = Catalog::findOne(['id' => Catalog::getRootCatalogId($id, Catalog::find()->all())])->title;

        $ids = Catalog::getCatalogIdStr($id, Catalog::find()->all());echo $ids;
        $query = Show::find()->where("catalog_id in ($ids)");
        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $show = $query->orderBy('create_time desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render($templatePage, ['catalog'=>$catalog, 'show'=>$show, 'portlet'=>$portlet, 'portletTitle'=>$portletTitle, 'pagination' => $pagination]);
    }

    public function actionShow()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if(0 >= $id)
            $this->redirect(Yii::$app->homeUrl);

        $show = Show::findOne(['id' => $id]);
        $catalog = Catalog::findOne(['id' => $show->catalog_id]);
        $templatePage = $show->template ? $show->template : $catalog->template_show ? $catalog->template_show : 'show';

        $portlet = Catalog::getCatalogSub2($id, Catalog::find()->all());
        $portletTitle = Catalog::findOne(['id' => Catalog::getRootCatalogId($id, Catalog::find()->all())])->title;

        return $this->render($templatePage, ['catalog'=>$catalog, 'show'=>$show, 'portlet'=>$portlet, 'portletTitle'=>$portletTitle]);
    }

}
