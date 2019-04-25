<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_coupon".
 *
 * @property int    $id
 * @property string $coupon_key   优惠券识别KEY
 * @property string $validity     优惠券有效日期
 * @property string $title        优惠券标题
 * @property string $denomination 优惠券面额
 * @property string $quota        优惠券使用限额
 * @property string $remarks      优惠券备注
 * @property string $coupon_type  卡卷类型：折扣劵 / 优惠卷
 * @property int    $created_at
 * @property int    $updated_at
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_coupon';
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
            [['title', 'deal_detail', 'denomination', 'quota', 'coupon_type', 'pay_type', 'description', 'code_type'], 'required'],
            [['denomination', 'quota', 'quantity'], 'integer'],
            [['coupon_type', 'images', 'service_phone', 'code_type'], 'string'],
            [['title'], 'string', 'max' => 125],
            [['description', 'begin_time_stamp', 'end_time_stamp',], 'string', 'max' => 500],
            [['coupon_key'], 'string', 'max' => 85],
            [['coupon_key'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['num'], 'default', 'value' => 10],
            [['service_phone'], 'default', 'value' => '40012234'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coupon_key'       => '优惠券识别KEY',
            'validity'         => '优惠券有效日期',
            'title'            => '优惠券标题',
            'denomination'     => '优惠券面额',
            'quota'            => '优惠券使用限额',
            'description'      => '卡券使用说明',
            'quantity'         => '卡券库存的数量，上限为100000000。',
            'images'           => '图片',
            'card_type'        => '卡卷类型',
            'pay_type'         => '赠送卡卷类型',
            'code_type'        => '二维码展示类型',
            'begin_time_stamp' => '起用时间',
            'end_time_stamp'   => '结束时间',
            'is_using'         => '卡卷状态',
            'created_at'       => '添加数据时间',
            'updated_at'       => '更新数据时间',
        ];
    }

    /**
     * 列表
     *
     * @param string $status
     *
     * @return array|Rooms[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = 'On')
    {

        // 审核状态
        $array = !empty( $status ) ? ['is_using' => $status] : ['!=', 'is_using', null];

        return static::find()->where( $array )
            ->orderBy( ['id' => SORT_DESC] )
            ->asArray()
            ->all();
    }

    /**
     * 选项框
     *
     * @return array|bool
     */
    public static function getSelect()
    {

        $data = static::findByAll( 'On' );

        if (empty( $data )) {
            return [];
        }

        $result = [];

        foreach ($data as $value) {
            $result[ $value['coupon_key'] ] = $value['title'];
        }

        return $result;
    }

}
