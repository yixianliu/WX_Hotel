<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_assist".
 *
 * @property int    $id
 * @property string $c_key       网站设置关键KEY
 * @property string $name        字段名
 * @property string $content     字段值
 * @property string $description 网站配置描述
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class Assist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_assist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_key', 'name', 'content', 'is_using'], 'required'],
            [['description', 'is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['c_key'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 85],
            [['content'], 'string', 'max' => 135],
            [['c_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_key'       => '关键KEY',
            'name'        => '配置 Key',
            'content'     => '配置内容',
            'description' => '配置描述',
            'is_using'    => '是否启用',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 网站辅助配置内容
     *
     * @return array
     */
    public static function findByData()
    {

        // 初始化
        $result = [];

        $data = static::find()->where(['is_using' => 'On'])->all();

        foreach ($data as $value) {
            $result[$value['name']] = $value['content'];
        }

        return $result;
    }
}
