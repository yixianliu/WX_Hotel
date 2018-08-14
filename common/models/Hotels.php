<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_hotels".
 *
 * @property int    $id
 * @property string $hotel_id     产品编号,唯一识别码
 * @property string $user_id      用户ID
 * @property string $c_key        产品分类KEY
 * @property string $title        产品标题
 * @property string $content      产品内容
 * @property string $num          房间数量
 * @property string $checkin_num  入住房间数量
 * @property string $price        一口价
 * @property string $discount     折扣价
 * @property string $introduction 导读,获取房间介绍第一段.
 * @property string $keywords     关键字
 * @property string $path         房间文件路径
 * @property string $thumb        房间缩略图
 * @property string $images       房间图片
 * @property string $is_promote   推广
 * @property string $is_audit     审核
 * @property string $is_field     是否生成字段JSON文件,没有生成的话,产品异常!
 * @property string $is_comments  是否启用评论
 * @property int    $created_at
 * @property int    $updated_at
 */
class Hotels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_hotels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_key', 'title', 'content', 'price',], 'required'],
            [['content', 'room_num', 'is_promote', 'is_audit', 'is_field', 'is_comments'], 'string'],
            [['num', 'check_in_num', 'price', 'discount', 'created_at', 'updated_at'], 'integer'],
            [['hotel_id', 'thumb', 'images'], 'string', 'max' => 85],
            [['user_id', 'c_key'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['introduction', 'path'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 120],
            [['hotel_id'], 'unique'],
            [['title'], 'unique'],

            [['is_promote', 'is_audit', 'is_field', 'is_comments'], 'default', 'value' => 'On'],
            [['num', 'check_in_num', 'room_num'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'     => '房间关键KEY',
            'user_id'      => '发布用户',
            'c_key'        => '房间分类',
            'room_num'     => '房间号码',
            'title'        => '房间标题',
            'content'      => '房间描述',
            'num'          => '房间数量',
            'check_in_num' => '入驻房间数量',
            'price'        => '价格',
            'discount'     => '折扣',
            'introduction' => '房间简介',
            'keywords'     => '房间关键词',
            'path'         => '文件目录',
            'thumb'        => '缩略图',
            'images'       => '房间图片',
            'is_promote'   => '是否推广',
            'is_audit'     => '是否启用',
            'is_comments'  => '是否开启评论',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }
	
	public static function findByAll()
	{
		
	}
}
