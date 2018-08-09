<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_auth_rule".
 *
 * @property string   $name
 * @property resource $data
 * @property int      $updated_at 最后一次更新时间
 * @property int      $created_at 插入时间
 */
class AuthRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['updated_at', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name'       => '规则名称',
            'data'       => '规则内容',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }
}
