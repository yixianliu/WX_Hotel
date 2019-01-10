<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_job".
 *
 * @property int    $id
 * @property string $job_id      招聘编号,唯一识别码
 * @property string $user_id     发布用户ID
 * @property string $title       标题
 * @property string $content     内容
 * @property string $keywords    关键字
 * @property string $images      招聘图片
 * @property string $is_language 语言类别
 * @property string $is_using    审核
 * @property int    $created_at
 * @property int    $updated_at
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_job';
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
            [['job_id', 'user_id', 'title', 'content', 'is_using'], 'required'],
            [['content', 'is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['job_id'], 'string', 'max' => 85],
            [['user_id'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['keywords'], 'string', 'max' => 120],
            [['images'], 'string', 'max' => 255],
            [['is_language'], 'string', 'max' => 25],
            [['job_id'], 'unique'],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'job_id'      => '招聘编号',
            'user_id'     => '发布用户ID',
            'title'       => '标题',
            'content'     => '内容',
            'keywords'    => '关键字',
            'images'      => '招聘图片',
            'is_language' => '语言类别',
            'is_using'    => '是否启用',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }
}
