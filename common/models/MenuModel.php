<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_menu_model".
 *
 * @property int    $id
 * @property string $m_key    菜单模型
 * @property string $sort_id  排序ID
 * @property string $url_type Url 类型
 * @property string $url_key  Url 模型关键KEY
 * @property string $name     模型名称
 * @property string $is_using 是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class MenuModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_menu_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['m_key', 'name'], 'required'],
            [['sort_id', 'created_at', 'updated_at'], 'integer'],
            [['is_using'], 'string'],
            [['m_key'], 'string', 'max' => 55],
            [['url_type', 'url_key', 'name'], 'string', 'max' => 125],
            [['m_key'], 'unique'],
            [['url_key'], 'unique'],

            [['is_using',], 'default', 'value' => 'On'],
            [['sort_id',], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'm_key'      => '关键KEY',
            'sort_id'    => '排序 Id',
            'url_type'   => 'Url 类型',
            'url_key'    => 'Url 模型',
            'name'       => '菜单模型名称',
            'is_using'   => '是否启用',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

    /**
     * 获取菜单模型
     *
     * @return array
     */
    public static function getModel()
    {

        // 初始化
        $data = [];

        $result = static::findAll( ['is_using' => 'On', 'menu_type' => 'model'] );

        foreach ($result as $value) {

            if (empty( $value->menu_key ))
                continue;

            $data[ $value->menu_key ] = $value->name;
        }

        return $data;
    }
}
