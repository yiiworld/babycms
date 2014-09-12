<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form about `common\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'is_nav', 'sort_order', 'page_size', 'click', 'status'], 'integer'],
            [['title', 'brief', 'content', 'seo_title', 'seo_keywords', 'seo_description', 'banner', 'page_type', 'template_list', 'template_show', 'template_page', 'redirect_url', 'create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Catalog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'is_nav' => $this->is_nav,
            'sort_order' => $this->sort_order,
            'page_size' => $this->page_size,
            'click' => $this->click,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'page_type', $this->page_type])
            ->andFilterWhere(['like', 'template_list', $this->template_list])
            ->andFilterWhere(['like', 'template_show', $this->template_show])
            ->andFilterWhere(['like', 'template_page', $this->template_page])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url]);

        return $dataProvider;
    }
}
