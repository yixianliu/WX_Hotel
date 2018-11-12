<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Hotels;

/**
 * HotelsSearch represents the model behind the search form of `common\models\Hotels`.
 */
class HotelsSearch extends Hotels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'created_at', 'updated_at' ], 'integer' ],
            [ [ 'hotel_id', 'user_id', 'name', 'content', 'address', 'introduction', 'keywords', 'path', 'images', 'is_promote', 'is_comments' ], 'safe' ],
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
        $query = Hotels::find()->orderBy( [
            'id'       => SORT_DESC,
            'hotel_id' => SORT_DESC,
        ] );

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider( [
            'query' => $query,
        ] );

        $this->load( $params );

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere( [
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ] );

        $query->andFilterWhere( [ 'like', 'hotel_id', $this->hotel_id ] )
            ->andFilterWhere( [ 'like', 'user_id', $this->user_id ] )
            ->andFilterWhere( [ 'like', 'name', $this->name ] )
            ->andFilterWhere( [ 'like', 'content', $this->content ] )
            ->andFilterWhere( [ 'like', 'introduction', $this->introduction ] )
            ->andFilterWhere( [ 'like', 'keywords', $this->keywords ] )
            ->andFilterWhere( [ 'like', 'path', $this->path ] )
            ->andFilterWhere( [ 'like', 'images', $this->images ] )
            ->andFilterWhere( [ 'like', 'is_promote', $this->is_promote ] )
            ->andFilterWhere( [ 'like', 'is_comments', $this->is_comments ] );

        return $dataProvider;
    }
}
