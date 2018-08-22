<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_order".
 *
 * @property int    $id
 * @property string $hotel_id    酒店编号
 * @property string $room_id     房间编号
 * @property string $user_id     用户ID
 * @property string $c_key       订单分类
 * @property string $price       价格
 * @property string $title       标题
 * @property string $content     描述内容
 * @property string $keywords    关键字
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id', 'room_id', 'user_id', 'c_key', 'price', 'title', 'content', 'pay_type', 'is_using'], 'required'],
            [['price', 'num', 'check_in', 'check_out', 'place_order', 'pay_order', 'created_at', 'updated_at'], 'integer'],
            [['content', 'pay_type', 'is_using'], 'string'],
            [['hotel_id', 'room_id', 'user_id', 'c_key', 'keywords', 'username', 'path'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'    => '所属酒店',
            'room_id'     => '房间 ID',
            'user_id'     => '用户 ID',
            'c_key'       => '房间分类',
            'price'       => '房间价格',
            'title'       => '房间标题',
            'content'     => '房间内容',
            'keywords'    => '房间关键词',
            'username'    => '入住人名称',
            'path'        => '订单目录',
            'num'         => '数量',
            'check_in'    => '入住时间',
            'check_out'   => '退房时间',
            'pay_type'    => '支付类型',
            'is_using'    => '审核状态',
            'place_order' => '下单时间',
            'pay_order'   => '支付时间',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }
}
