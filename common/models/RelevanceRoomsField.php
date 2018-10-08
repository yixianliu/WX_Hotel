<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_relevance_hotels_field".
 *
 * @property int    $id
 * @property string $f_key    房间参数关键KEY
 * @property string $hotel_id 房间关键KEY
 * @property int    $created_at
 * @property int    $updated_at
 */
class RelevanceRoomsField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_relevance_rooms_field';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [ [ 'f_key', 'rooms_id', 'content' ], 'required' ],
            [ [ 'created_at', 'updated_at' ], 'integer' ],
            [ [ 'f_key', 'rooms_id', 'content' ], 'string', 'max' => 85 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'f_key'      => '关联KEY',
            'rooms_id'   => '房间参数KEY',
            'content'    => '房间参数内容',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }
}
