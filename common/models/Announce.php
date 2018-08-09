<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_announce".
 *
 * @property int    $id
 * @property string $user_id   用户ID
 * @property string $title     标题
 * @property string $content   内容
 * @property string $is_audit  审核
 * @property string $published 发布时间
 */
class Announce extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%announce}}';
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
            [['title', 'content'], 'required'],
            [['is_audit'], 'string'],
            [['user_id', 'title'], 'string', 'max' => 55],
            [['content'], 'string', 'max' => 80],
            [['title'], 'unique'],

            [['is_audit'], 'default', 'value' => 'on'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'    => '发布者',
            'title'      => '标题',
            'content'    => '内容',
            'is_audit'   => '审核状态',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }
	
	public static function findByAll()
	{
		return static::find()->where(['is_audit' => 'On'])
            ->orderBy('id', 'ASC')
            ->asArray()
            ->all();
	}

}
