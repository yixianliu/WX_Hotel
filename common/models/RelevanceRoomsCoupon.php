<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_relevance_rooms_coupon".
 *
 * @property int    $id
 * @property string $user_id    房间参数关键KEY
 * @property string $coupon_key 房间关键KEY
 * @property int    $created_at
 * @property int    $updated_at
 */
class RelevanceRoomsCoupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_relevance_rooms_coupon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_ide', 'coupon_key'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['user_id', 'coupon_key'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'room_id'    => '房间关键KEY',
            'coupon_key' => '优惠卷关键KEY',
            'use_up'     => '消费了多少张优惠卷',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

    // 菜单模型
    public function getRooms()
    {
        return $this->hasOne(MenuModel::className(), ['room_id' => 'room_id']);
    }

}
