<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_rooms".
 *
 * @property int    $id
 * @property string $hotel_id     酒店编号,唯一识别码
 * @property string $room_id      房间编号,唯一识别码
 * @property string $user_id      用户ID
 * @property string $c_key        房间分类KEY
 * @property string $room_num     房间号码
 * @property string $title        产品标题
 * @property string $content      产品内容
 * @property string $num          房间数量
 * @property string $check_in_num 入住房间数量
 * @property string $price        一口价
 * @property string $discount     折扣价
 * @property string $introduction 导读,获取房间介绍第一段.
 * @property string $keywords     关键字
 * @property string $path         房间文件路径
 * @property string $thumb        房间缩略图
 * @property string $images       房间图片
 * @property string $is_promote   推广
 * @property string $is_using     审核
 * @property string $is_comments  是否启用评论
 * @property int    $created_at
 * @property int    $updated_at
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms';
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
            [['hotel_id', 'c_key', 'room_num', 'title', 'content', 'num', 'check_in_num', 'price'], 'required'],
            [['content', 'is_promote', 'is_using', 'is_comments'], 'string'],
            [['num', 'check_in_num', 'price', 'discount', 'created_at', 'updated_at'], 'integer'],
            [['hotel_id', 'room_id', 'thumb', 'images'], 'string', 'max' => 85],
            [['user_id', 'c_key', 'room_num'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['introduction', 'path'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 120],
            [['hotel_id'], 'unique'],
            [['title'], 'unique'],

            [['is_promote', 'is_using', 'is_comments'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'     => '所属酒店',
            'room_id'      => '房间 ID',
            'user_id'      => '用户 ID',
            'c_key'        => '房间分类',
            'room_num'     => '房间号码',
            'title'        => '房间标题',
            'content'      => '房间描述',
            'num'          => '房间数量',
            'check_in_num' => '入住数量',
            'price'        => '房间价格',
            'discount'     => '折扣价格',
            'introduction' => '房间导读',
            'keywords'     => '房间关键词',
            'path'         => '房间目录',
            'thumb'        => '房间缩略图',
            'images'       => '房间图片',
            'is_promote'   => '是否推广',
            'is_using'     => '是否审核',
            'is_comments'  => '是否开启留言',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }

    public static function findByAll()
    {

    }

}
