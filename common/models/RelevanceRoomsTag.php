<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_relevance_rooms_tag".
 *
 * @property int    $id
 * @property string $t_key    房间参数关键KEY
 * @property string $hotel_id 房间关键KEY
 * @property int    $created_at
 * @property int    $updated_at
 */
class RelevanceRoomsTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_relevance_rooms_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_key', 'rooms_id'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['t_key', 'rooms_id'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            't_key'      => '标签关键KEY',
            'rooms_id'   => '房间ID',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

}
