<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog}}".
 *
 * @property string $id
 * @property integer $parent_id
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $banner
 * @property integer $is_nav
 * @property string $sort_order
 * @property string $page_type
 * @property integer $page_size
 * @property string $template_list
 * @property string $template_show
 * @property string $template_page
 * @property string $redirect_url
 * @property string $click
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property Show[] $shows
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;

    public static function tableName()
    {
        return '{{%catalog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_nav', 'sort_order', 'page_size', 'click', 'status'], 'integer'],
            [['title'], 'required'],
            [['content', 'page_type'], 'string'],
            [['create_time', 'update_time', 'banner'], 'safe'],
            [['title', 'seo_title', 'seo_keywords', 'banner', 'template_list', 'template_show', 'template_page', 'redirect_url'], 'string', 'max' => 255],
            [['brief', 'seo_description'], 'string', 'max' => 1022],
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', '上级名称'),
            'title' => Yii::t('app', '名称'),
            'brief' => Yii::t('app', '摘要'),
            'content' => Yii::t('app', '内容'),
            'seo_title' => Yii::t('app', 'SEO标题'),
            'seo_keywords' => Yii::t('app', 'SEO关键字'),
            'seo_description' => Yii::t('app', 'SEO描述'),
            'banner' => Yii::t('app', 'Banner图片'),
            'is_nav' => Yii::t('app', '是否导航显示'),
            'sort_order' => Yii::t('app', '排序'),
            'page_type' => Yii::t('app', '类型'),
            'page_size' => Yii::t('app', '每页显示数量'),
            'template_list' => Yii::t('app', '列表模板'),
            'template_show' => Yii::t('app', '内容页模板'),
            'template_page' => Yii::t('app', '单页模板'),
            'redirect_url' => Yii::t('app', '外部链接'),
            'click' => Yii::t('app', '查看次数'),
            'status' => Yii::t('app', '状态 1正常，0禁用'),
            'create_time' => Yii::t('app', '录入时间'),
            'update_time' => Yii::t('app', '修改时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShows()
    {
        return $this->hasMany(Show::className(), ['catalog_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($this->isNewRecord)
            {
                $this->create_time = date('Y-m-d H:i:s');
                $this->update_time = date('Y-m-d H:i:s');
            }
            else
            {
                $this->update_time = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    static public function get($parentId = 0, $array = array(), $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        if ($level>1) {
            for($j = 0; $j < $level; $j ++)
            {
                $strRepeat .= $repeat;
            }
        }
        if($level>0)
            $strRepeat .= '';

        $newArray = array ();
        $tempArray = array ();
        foreach ( ( array ) $array as $v )
        {
            if ($v['parent_id'] == $parentId)
            {
                $newArray [] = array ('id' => $v['id'], 'title' => $v['title'], 'parent_id' => $v['parent_id'], 'level' => $level, 'sort_order' => $v['sort_order'], 'brief' => $v['brief'],
                    'content' => $v['content'], 'seo_title' => $v['seo_title'], 'seo_keywords' => $v['seo_keywords'], 'seo_description' => $v['seo_description'], 'banner' => $v['banner'],
                    'is_nav' => $v['is_nav'], 'page_type' => $v['page_type'], 'page_size' => $v['page_size'],'template_list' => $v['template_list'],'template_show' => $v['template_show'],'template_page' => $v['template_page'],
                    'status' => $v['status'], 'create_time' => $v['create_time'], 'update_time' => $v['update_time'], 'redirect_url' => $v['redirect_url'], 'str_repeat' => $strRepeat, 'str_label' => $strRepeat.$v['title'],);

                $tempArray = self::get ( $v['id'], $array, ($level + $add) );
                if ($tempArray)
                {
                    $newArray = array_merge ( $newArray, $tempArray );
                }
            }
        }
        return $newArray;
    }

    static public function getCatalog($parentId=0,$array = array())
    {
        $newArray=array();
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$parentId)
            {
                $newArray[$v['id']]=array(
                    'text'=>$v['title'].' 导航['.($v['is_nav'] ? Yii::t('common', 'CONSTANT_YES') : Yii::t('common', 'CONSTANT_NO')).'] 排序['.$v['sort_order'].'] 类型['.($v['page_type'] == 'list' ? Yii::t('common', 'PAGE_TYPE_LIST') : Yii::t('common', 'PAGE_TYPE_PAGE')).'] 状态['.F::getStatus2($v['status']).'] [<a href="'.Yii::app()->createUrl('/catalog/update',array('id'=>$v['id'])).'">修改</a>][<a href="'.Yii::app()->createUrl('/catalog/create',array('id'=>$v['id'])).'">增加子菜单</a>]&nbsp;&nbsp[<a href="'.Yii::app()->createUrl('/catalog/delete',array('id'=>$v['id'])).'">删除</a>]',
                    //'children'=>array(),
                );

                $tempArray = self::getCatalog($v['id'],$array);
                if($tempArray)
                {
                    $newArray[$v['id']]['children']=$tempArray;
                }
            }
        }
        return $newArray;
    }

    static public function getCatalogIdStr($parentId=0,$array = array())
    {
        $str = $parentId;
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$parentId)
            {

                $tempStr = self::getCatalogIdStr($v['id'],$array);
                if($tempStr)
                {
                    $str .= ','.$tempStr;
                }
            }
        }
        return $str;
    }

    static public function getRootCatalogId($id=0,$array = array())
    {
        if(0 == $id)
        {
            return 0;
        }

        foreach ((array)$array as $v)
        {
            if ($v['id']==$id)
            {
                $parentId = $v['parent_id'];
                if(0 == $parentId)
                    return $id;
                else
                    return self::getRootCatalogId($parentId,$array);
            }
        }
    }

    static public function getCatalogSub2($id=0,$array = array())
    {
        if(0 == $id)
        {
            return 0;
        }

        $arrayResult = array();
        $rootId = Catalog::getRootCatalogId($id, $array);
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$rootId)
            {
                array_push($arrayResult, $v);
            }
        }

        return $arrayResult;
    }

    static public function getBreadcrumbs($id=0,$array = array())
    {
        if(0 == $id)
        {
            return;
        }

        $arrayResult = Catalog::getPathToRoot($id, $array);

        return array_reverse($arrayResult);
    }

    static public function getPathToRoot($id=0,$array = array())
    {
        if(0 == $id)
        {
            return array();
        }

        $arrayResult=array();
        $parent_id = 0;
        foreach ((array)$array as $v)
        {
            if($v['id']==$id)
            {
                $parent_id = $v['parent_id'];
                if(CONSTANT::PAGE_TYPE_LIST == $v['page_type'])
                    $arrayResult = array($v['title']=>array('list', id=>$v['id']));
                elseif(CONSTANT::PAGE_TYPE_PAGE == $v['page_type'])
                    $arrayResult = array($v['title']=>array('page', id=>$v['id']));
            }
        }

        if(0 < $parent_id)
        {
            $arrayTemp = Catalog::getPathToRoot($parent_id,$array);

            if(!empty($arrayTemp))
                $arrayResult += $arrayTemp;
        }

        if(!empty($arrayResult))
            return $arrayResult;
        else
            return;
    }

    public static function getMainNav($currentId = 0)
    {
        $mainMenu = [['label'=>Yii::t('app','Home'), 'url'=>array('/site/index'), 'active'=>(0==$currentId)]];
        $allCatalog = Catalog::find()->where("parent_id=0")->orderBy(['sort_order' => SORT_ASC,'id' => SORT_ASC,])->all();
        foreach($allCatalog as $catalog)
        {
            $item = [];
            if($catalog->redirect_url)
            {// redirect to other site
                $item = ['label'=>$catalog->title, 'url'=>$catalog->redirect_url, 'active'=>($catalog->id==$currentId)];
            }
            else
            {
                if('list' == $catalog->page_type)
                    $item = ['label'=>$catalog->title, 'url'=>['/site/list/','id'=>$catalog->id], 'active'=>($catalog->id==$currentId)];
                else
                    $item = ['label'=>$catalog->title, 'url'=>['/site/page/','id'=>$catalog->id], 'active'=>($catalog->id==$currentId)];
            }

            if(!empty($item))
                array_push($mainMenu, $item);
        }
        return $mainMenu;
    }
}

