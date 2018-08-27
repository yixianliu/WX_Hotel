<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * SearchArticle represents the model behind the search form of `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'praise', 'forward', 'collection', 'share', 'attention', 'created_at', 'updated_at'], 'integer'],
            [['article_id', 'user_id', 'c_key', 'title', 'content', 'introduction', 'keywords', 'path', 'is_promote', 'is_hot', 'is_classic', 'is_winnow', 'is_recommend', 'is_comments', 'is_using'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'praise' => $this->praise,
            'forward' => $this->forward,
            'collection' => $this->collection,
            'share' => $this->share,
            'attention' => $this->attention,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'article_id', $this->article_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'c_key', $this->c_key])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'is_promote', $this->is_promote])
            ->andFilterWhere(['like', 'is_hot', $this->is_hot])
            ->andFilterWhere(['like', 'is_classic', $this->is_classic])
            ->andFilterWhere(['like', 'is_winnow', $this->is_winnow])
            ->andFilterWhere(['like', 'is_recommend', $this->is_recommend])
            ->andFilterWhere(['like', 'is_comments', $this->is_comments])
            ->andFilterWhere(['like', 'is_using', $this->is_using]);

        return $dataProvider;
    }
}
