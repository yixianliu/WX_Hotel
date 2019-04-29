<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_coupon".
 *
 * @property int    $id
 * @property string $coupon_key   卡券识别KEY
 * @property string $validity     卡券有效日期
 * @property string $title        卡券标题
 * @property string $denomination 卡券面额
 * @property string $quota        卡券使用限额
 * @property string $remarks      卡券备注
 * @property string $card_type    卡卷类型：折扣劵 / 优惠卷
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
            [['title', 'brand_name', 'denomination', 'quota', 'card_type', 'pay_type', 'description', 'code_type', 'begin_time_stamp', 'end_time_stamp'], 'required'],
            [['denomination', 'quota', 'quantity'], 'integer'],
            [['card_type', 'images', 'service_phone', 'code_type', 'deal_detail'], 'string'],
            [['card_id'], 'string', 'max' => 125],
            [['title'], 'string', 'max' => 9],
            [['description'], 'string', 'max' => 500],
            [['coupon_key'], 'string', 'max' => 85],
            [['coupon_key'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['quantity'], 'default', 'value' => 999],
            [['service_phone'], 'default', 'value' => '40012234'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'card_id'          => '公众号生成卡券的Id',
            'coupon_key'       => '卡券识别KEY',
            'brand_name'       => '商户名字,字数上限为12个汉字。',
            'title'            => '卡券标题，字数上限为9个汉字。',
            'denomination'     => '卡券面额',
            'quota'            => '卡券使用限额',
            'description'      => '卡券使用说明',
            'quantity'         => '卡券库存的数量，上限为100000000。',
            'images'           => '素材图片',
            'card_type'        => '卡卷类型',
            'pay_type'         => '赠送卡卷类型',
            'code_type'        => '二维码展示类型',
            'begin_time_stamp' => '开始时间',
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
