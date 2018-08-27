<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_hotels".
 *
 * @property int    $id
 * @property string $hotel_id     产品编号,唯一识别码
 * @property string $user_id      用户ID
 * @property string $c_key        产品分类KEY
 * @property string $title        产品标题
 * @property string $content      产品内容
 * @property string $num          酒店数量
 * @property string $checkin_num  入住酒店数量
 * @property string $price        一口价
 * @property string $discount     折扣价
 * @property string $introduction 导读,获取酒店介绍第一段.
 * @property string $keywords     关键字
 * @property string $path         酒店文件路径
 * @property string $thumb        酒店缩略图
 * @property string $images       酒店图片
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['content', 'is_promote', 'is_using', 'is_comments'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['hotel_id', 'thumb', 'images',], 'string', 'max' => 85],
            [['user_id'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 125],
            [['introduction', 'path'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 120],
            [['hotel_id'], 'unique'],
            [['name'], 'unique'],

            [['is_promote', 'is_using', 'is_comments'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'     => '酒店关键KEY',
            'user_id'      => '发布用户',
            'name'         => '酒店名称',
            'content'      => '酒店描述',
            'introduction' => '酒店简介',
            'keywords'     => '酒店关键词',
            'thumb'        => '缩略图',
            'images'       => '酒店图片',
            'is_promote'   => '是否推广',
            'is_using'     => '是否启用',
            'is_comments'  => '是否开启评论',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }

    public static function findByAll($status = null)
    {

        // 审核状态
        $array = !empty($status) ? ['is_using' => $status] : ['!=', 'is_using', ''];

        return static::find()->where($array)->asArray()->all();
    }
}
