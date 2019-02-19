<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_resume".
 *
 * @property int $id
 * @property string $user_id 用户ID
 * @property string $title 简历标题
 * @property string $content 简历内容
 * @property string $path 上传简历路径
 * @property string $is_using 是否启用
 * @property int $created_at
 * @property int $updated_at
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content', 'is_using'], 'required'],
            [['content', 'is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['user_id'], 'string', 'max' => 85],
            [['title', 'path'], 'string', 'max' => 125],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'title' => '简历标题',
            'content' => '简历内容',
            'path' => '上传简历路径',
            'is_using' => '是否启用',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
