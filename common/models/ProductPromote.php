<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_Product_Promote".
 *
 * @property int    $promote_id
 * @property string $product_id  产品ID
 * @property string $sort_id     排序ID
 * @property string $location    位置
 * @property string $orientation 方位
 * @property string $name        字段名
 * @property string $content     字段值
 */
class ProductPromote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_Product_Promote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['product_id', 'location', 'orientation'], 'required'],
            [['product_id', 'sort_id'], 'integer'],
            [['location', 'orientation'], 'string'],
            [['name'], 'string', 'max' => 55],
            [['content'], 'string', 'max' => 255],

            [['sort_id'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

        return [
            'promote_id'  => '推广 Id',
            'product_id'  => '所属产品',
            'sort_id'     => '排序',
            'location'    => '所属页面',
            'orientation' => '所属位置',
            'name'        => '名字',
            'content'     => '内容',
        ];
    }
}
