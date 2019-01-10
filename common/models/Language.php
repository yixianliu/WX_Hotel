<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_language".
 *
 * @property int    $id
 * @property string $lang_key 网站设置关键KEY
 * @property string $name     字段名
 * @property string $content  国家缩写
 * @property string $is_using 是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_language';
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
            [['lang_key', 'name', 'content', 'is_default'], 'required'],
            [['is_using', 'is_default'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['lang_key'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 85],
            [['content'], 'string', 'max' => 135],
            [['lang_key'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lang_key'   => '网站设置关键KEY',
            'name'       => '字段名',
            'content'    => '国家缩写',
            'is_using'   => '是否启用',
            'is_default' => '是否设为默认',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

    /**
     * 获取语言类别(选项框)
     *
     * @return array
     */
    public static function getLangSelect()
    {
        // 初始化
        $result = [];

        $dataClassify = static::findAll( ['is_using' => 'On'] );

        foreach ($dataClassify as $key => $value) {
            $result[ $value['lang_key'] ] = $value['name'];
        }

        return $result;
    }
}
