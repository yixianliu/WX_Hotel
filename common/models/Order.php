<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_order".
 *
 * @property int    $id
 * @property string $hotel_id    酒店编号
 * @property string $room_id     房间编号
 * @property string $user_id     用户ID
 * @property string $price       价格
 * @property string $title       标题
 * @property string $content     描述内容
 * @property string $username    制单人
 * @property string $path        订单路径
 * @property int    $num         入住人数
 * @property int    $check_in    入住时间
 * @property int    $check_out   退房时间
 * @property string $pay_type    支付方式
 * @property string $is_using    审核
 * @property int    $place_order 下单时间
 * @property int    $pay_order   支付时间
 * @property int    $created_at
 * @property int    $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_order';
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
            [['title', 'content', 'pay_type', 'check_in', 'check_out', 'checkin_men_num', 'checkin_men_name', 'checkin_men_idcard'], 'required'],
            [['price', 'num', 'place_order', 'pay_order', 'checkin_men_num'], 'integer'],
            [['hotel_id', 'room_id', 'user_id', 'content', 'pay_type', 'c_key', 'check_in', 'check_out', 'is_using', 'checkin_men_name', 'checkin_men_idcard'], 'string'],
            [['hotel_id', 'room_id', 'user_id', 'c_key', 'check_in', 'check_out', 'username'], 'string', 'max' => 85],
            [['checkin_men_name'], 'string', 'max' => 10],
            [['checkin_men_idcard'], 'string', 'max' => 32],
            [['path'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 125],

            [['is_using',], 'default', 'value' => 'Off'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'           => '所属酒店',
            'room_id'            => '房间',
            'user_id'            => '用户',
            'price'              => '订单价格',
            'title'              => '订单标题',
            'content'            => '订单内容',
            'keywords'           => '房间关键词',
            'username'           => '入住人名称',
            'path'               => '订单目录',
            'checkin_men_num'    => '入住人数',
            'checkin_men_name'   => '入住人名称',
            'checkin_men_idcard' => '入住人身份证',
            'check_in'           => '入住时间',
            'check_out'          => '退房时间',
            'pay_type'           => '支付类型',
            'is_using'           => '审核状态',
            'place_order'        => '下单时间',
            'pay_order'          => '支付时间',
            'created_at'         => '添加数据时间',
            'updated_at'         => '更新数据时间',
        ];
    }

    /**
     * @abstract 获取酒店
     */
    public function getHotels()
    {
        return $this->hasOne(Hotels::className(), ['hotel_id' => 'hotel_id']);
    }

    /**
     * @abstract 获取用户
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @abstract 获取房间
     */
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['room_id' => 'room_id']);
    }

}
