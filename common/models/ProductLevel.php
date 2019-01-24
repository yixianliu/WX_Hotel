<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_product_level".
 *
 * @property int    $id
 * @property string $l_key       等级KEY
 * @property string $sort_id     排序
 * @property string $name        等级名称
 * @property string $description 等级描述
 * @property string $exp         经验值
 * @property string $ico_class   等级图标样式
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class ProductLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_product_level';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort_id', 'exp', 'created_at', 'updated_at'], 'integer'],
            [['description', 'is_using'], 'string'],
            [['l_key', 'name'], 'string', 'max' => 55],
            [['ico_class'], 'string', 'max' => 125],
            [['l_key'], 'unique'],
            [['name'], 'unique'],

            [['is_using',], 'default', 'value' => 'On'],
            [['sort_id', 'exp'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'l_key'       => '产品等级关键KEY',
            'sort_id'     => '排序ID',
            'name'        => '等级名称',
            'description' => '等级描述',
            'exp'         => '经验值',
            'json_data'   => 'Json 数据',
            'is_using'    => '是否开启',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 产品列表
     *
     * @param string $status
     *
     * @return array|Product[]|ProductLevel[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = 'On')
    {

        return static::find()->where( ['is_using' => $status] )
            ->orderBy( ['sort_id' => SORT_DESC] )
            ->asArray()
            ->all();
    }

    /**
     * 获取分类(选项框)
     *
     * @return array
     */
    public static function getClsSelect()
    {

        // 初始化
        $result = [];

        // 产品分类
        $data = static::findByAll( 'On' );

        foreach ($data as $key => $value) {
            $result[ $value['l_key'] ] = $value['name'];
        }

        return $result;
    }

}
