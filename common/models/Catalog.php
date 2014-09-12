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
            [['create_time', 'update_time'], 'safe'],
            [['title', 'seo_title', 'seo_keywords', 'banner', 'template_list', 'template_show', 'template_page', 'redirect_url'], 'string', 'max' => 255],
            [['brief', 'seo_description'], 'string', 'max' => 1022]
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
}
