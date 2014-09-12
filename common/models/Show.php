<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%show}}".
 *
 * @property string $id
 * @property string $catalog_id
 * @property string $user_id
 * @property string $author
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $banner
 * @property string $template
 * @property string $redirect_url
 * @property string $click
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property Catalog $catalog
 */
class Show extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%show}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'title'], 'required'],
            [['catalog_id', 'user_id', 'click', 'status'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['author', 'title', 'seo_title', 'seo_keywords', 'banner', 'template', 'redirect_url'], 'string', 'max' => 255],
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
            'catalog_id' => Yii::t('app', '分类'),
            'user_id' => Yii::t('app', '用户'),
            'author' => Yii::t('app', '作者'),
            'title' => Yii::t('app', '标题'),
            'brief' => Yii::t('app', '摘要'),
            'content' => Yii::t('app', '内容'),
            'seo_title' => Yii::t('app', 'SEO标题'),
            'seo_keywords' => Yii::t('app', 'SEO关键字'),
            'seo_description' => Yii::t('app', 'SEO描述'),
            'banner' => Yii::t('app', 'banner图片'),
            'template' => Yii::t('app', '模板'),
            'redirect_url' => Yii::t('app', '外部链接'),
            'click' => Yii::t('app', '查看次数'),
            'status' => Yii::t('app', '状态 1正常，0禁用'),
            'create_time' => Yii::t('app', '添加时间'),
            'update_time' => Yii::t('app', '修改时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}
