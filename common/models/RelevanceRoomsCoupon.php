<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
     * @inheritdoc
     */
    public function behaviors() {
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
            [['user_id', 'room_id', 'coupon_key', 'hotel_id', 'apply_range'], 'required'],
            [['content'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'     => '发布用户',
            'room_id'     => '所选房间',
            'hotel_id'    => '所选酒店',
            'coupon_key'  => '优惠卷',
            'use_up'      => '消费了多少张优惠卷',
            'content'     => '优惠卷描述',
            'apply_range' => '派送类别',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    // 房间模型
    public function getRooms()
    {
        return $this->hasOne( MenuModel::className(), ['room_id' => 'room_id'] );
    }

    // 卡卷模型
    public function getCoupon()
    {
        return $this->hasOne( Coupon::className(), ['coupon_key' => 'coupon_key'] );
    }

}
