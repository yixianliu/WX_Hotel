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
            [['title', 'validity', 'denomination', 'quota', 'coupon_type', 'pay_type'], 'required'],
            [['denomination', 'quota', 'num'], 'integer'],
            [['coupon_type', 'images'], 'string'],
            [['validity', 'title', 'remarks'], 'string', 'max' => 125],
            [['coupon_key'], 'string', 'max' => 85],
            [['coupon_key'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['num'], 'default', 'value' => 10],
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
            'num'          => '优惠券数量',
            'images'       => '图片',
            'coupon_type'  => '卡卷类型',
            'pay_type'     => '赠送卡卷类型',
            'is_using'     => '卡卷状态',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
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
            return false;
        }

        $result = [];

        foreach ($data as $value) {
            $result[ $value['coupon_key'] ] = $value['title'];
        }

        return $result;
    }

}
