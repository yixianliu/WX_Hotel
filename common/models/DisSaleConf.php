<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_dis_sale_conf".
 *
 * @property int    $id
 * @property string $user_id          用户 Id
 * @property string $parent_user_id   上一级 用户 Id
 * @property double $commission_one   一级佣金
 * @property double $commission_two   二级佣金
 * @property double $commission_three 三级佣金
 * @property double $commission_me    自我分佣,开启后，已成为金牌用户的客户，自己购买商品也可以分到佣金，比例总和要小于或者等于1
 * @property string $is_using         是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class DisSaleConf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_dis_sale_conf';
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
            [['user_id', 'commission_one', 'commission_two', 'commission_three', 'commission_me'], 'required'],
            [['commission_one', 'commission_two', 'commission_three', 'commission_me'], 'number'],
            [['is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['commission_one', 'commission_two', 'commission_three', 'commission_me'], 'double'],
            [['user_id'], 'string', 'max' => 85],

            [['is_using', 'is_commission_me'], 'default', 'value' => 'On']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'          => '用户 Id',
            'parent_user_id'   => '上一级 用户 Id',
            'commission_one'   => '一级佣金',
            'commission_two'   => '二级佣金',
            'commission_three' => '三级佣金',
            'commission_me'    => '自我分佣',
            'is_using'         => '是否启用',
            'created_at'       => '添加数据时间',
            'updated_at'       => '更新数据时间',
        ];
    }
}
