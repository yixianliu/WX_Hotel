<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_product_image".
 *
 * @property int $image_id
 * @property string $product_id 产品ID
 * @property string $user_id 用户ID
 * @property string $path 图片路径
 * @property int $primary 封面图片,值为1的时候,该图片为封面
 * @property string $published 发布时间
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'path', 'published'], 'required'],
            [['primary', 'published'], 'integer'],
            [['product_id', 'user_id'], 'string', 'max' => 55],
            [['path'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'path' => 'Path',
            'primary' => 'Primary',
            'published' => 'Published',
        ];
    }
}
