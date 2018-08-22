<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_rooms_classify".
 *
 * @property int    $id
 * @property string $c_key       分类KEY
 * @property string $sort_id     排序
 * @property string $name        房间名称
 * @property string $description 描述
 * @property string $keywords    关键字
 * @property string $json_data   Json 数据
 * @property string $parent_id   父类ID
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class RoomsClassify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms_classify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_key', 'name', 'parent_id'], 'required'],
            [['sort_id', 'created_at', 'updated_at'], 'integer'],
            [['description', 'is_using'], 'string'],
            [['c_key', 'keywords', 'json_data', 'parent_id'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 85],
            [['c_key'], 'unique'],
            [['name'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['sort_id'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'c_key'       => '分类关键KEY',
            'sort_id'     => '排序 ID',
            'name'        => '分类名称',
            'description' => '分类描述',
            'keywords'    => '分类关键词',
            'json_data'   => 'Json 数据',
            'parent_id'   => '父类分类',
            'is_using'    => '审核状态',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    public static function findByAll()
    {

    }

}
