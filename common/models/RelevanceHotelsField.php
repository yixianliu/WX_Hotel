<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_relevance_hotels_field".
 *
 * @property int    $id
 * @property string $f_key    房间参数关键KEY
 * @property string $hotel_id 房间关键KEY
 * @property int    $created_at
 * @property int    $updated_at
 */
class RelevanceHotelsField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_relevance_hotels_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_key', 'hotel_id'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['f_key', 'hotel_id'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'f_key'      => 'F Key',
            'hotel_id'   => 'Hotel ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
