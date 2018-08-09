<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_user_problems".
 *
 * @property int $id
 * @property string $security_key 安全问题KEY
 * @property string $name 问题
 * @property string $is_using 是否启用
 * @property int $created_at
 * @property int $updated_at
 */
class UserProblems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_user_problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['security_key', 'name'], 'required'],
            [['is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['security_key'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 55],
            [['security_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'security_key' => 'Security Key',
            'name' => 'Name',
            'is_using' => 'Is Using',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
