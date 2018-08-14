<?php

namespace common\models;

use Yii;

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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['validity', 'denomination', 'quota', 'coupon_type'], 'required'],
            [['denomination', 'quota', 'created_at', 'updated_at'], 'integer'],
            [['coupon_type'], 'string'],
            [['coupon_key', 'validity', 'title', 'remarks'], 'string', 'max' => 125],
            [['coupon_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coupon_key'   => '优惠券识别KEY',
            'validity'     => '优惠券有效日期',
            'title'        => '优惠券标题',
            'denomination' => '优惠券面额',
            'quota'        => '优惠券使用限额',
            'remarks'      => '优惠券备注',
            'coupon_type'  => '卡卷类型',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }
}