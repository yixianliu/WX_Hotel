<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_dis_sale_user".
 *
 * @property int    $id
 * @property string $user_id        用户 Id
 * @property string $wx_user_id     微信 Id
 * @property string $parent_user_id 上一级 用户 Id
 * @property string $is_using       是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class DisSaleUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_dis_sale_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'wx_user_id', 'parent_user_id', 'is_using'], 'required'],
            [['is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['user_id', 'wx_user_id', 'parent_user_id'], 'string', 'max' => 85],

            [['is_using'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'        => '用户 Id',
            'wx_user_id'     => '微信 Id',
            'parent_user_id' => '上一级 用户 Id',
            'is_using'       => '是否启用',
            'created_at'     => '添加数据时间',
            'updated_at'     => '更新数据时间',
        ];
    }
}
