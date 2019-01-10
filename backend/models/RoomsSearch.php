<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rooms;

/**
 * SearchRooms represents the model behind the search form of `common\models\Rooms`.
 */
class RoomsSearch extends Rooms
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [ [ 'num', 'check_in_num', 'price', 'discount', 'created_at', 'updated_at' ], 'integer' ],
            [ [ 'hotel_id', 'rooms_id', 'user_id', 'c_key', 'room_num', 'title', 'content', 'introduction', 'keywords', 'path', 'thumb', 'images', 'is_promote', 'is_using', 'is_comments' ], 'safe' ],
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
        $query = Rooms::find()->orderBy( [
            'id'      => SORT_DESC,
            'room_id' => SORT_DESC,
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
            'num'          => $this->num,
            'check_in_num' => $this->check_in_num,
            'price'        => $this->price,
            'discount'     => $this->discount,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ] );

        $query->andFilterWhere( [ 'like', 'hotel_id', $this->hotel_id ] )
            ->andFilterWhere( [ 'like', 'rooms_id', $this->rooms_id ] )
            ->andFilterWhere( [ 'like', 'user_id', $this->user_id ] )
            ->andFilterWhere( [ 'like', 'c_key', $this->c_key ] )
            ->andFilterWhere( [ 'like', 'room_num', $this->room_num ] )
            ->andFilterWhere( [ 'like', 'title', $this->title ] )
            ->andFilterWhere( [ 'like', 'content', $this->content ] )
            ->andFilterWhere( [ 'like', 'introduction', $this->introduction ] )
            ->andFilterWhere( [ 'like', 'keywords', $this->keywords ] )
            ->andFilterWhere( [ 'like', 'path', $this->path ] )
            ->andFilterWhere( [ 'like', 'thumb', $this->thumb ] )
            ->andFilterWhere( [ 'like', 'images', $this->images ] )
            ->andFilterWhere( [ 'like', 'is_promote', $this->is_promote ] )
            ->andFilterWhere( [ 'like', 'is_using', $this->is_using ] )
            ->andFilterWhere( [ 'like', 'is_comments', $this->is_comments ] );

        return $dataProvider;
    }
}
