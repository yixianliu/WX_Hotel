<?php

/**
 * @abstract 产品模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Conf extends ActiveRecord
{

    /**
     * 数据库表名
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%conf}}';
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
            [ [ 'c_key', 'name', 'parameter' ], 'required' ],
            [ [ 'description', 'is_using', 'is_language' ], 'string' ],
            [ [ 'c_key' ], 'string', 'max' => 55 ],
            [ [ 'name' ], 'string', 'max' => 80 ],
            [ [ 'parameter' ], 'string', 'max' => 255 ],

            [ [ 'is_language' ], 'default', 'value' => 'cn' ],
            [ [ 'is_using' ], 'default', 'value' => 'On' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_key'       => '网站配置关键KEY',
            'name'        => '配置名称',
            'parameter'   => '配置值',
            'description' => '配置描述',
            'is_using'    => '是否启用',
            'is_language' => '语言分类',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 网站配置数据
     *
     * @param null   $status
     * @param string $language
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = null, $language = 'cn')
    {

        $array = !empty( $status ) ? [ 'is_using' => $status ] : [ '!=', 'is_using', 'null' ];

        return static::find()->where( $array )
            ->andWhere( [ 'is_language' => $language ] )
            ->asArray()
            ->all();
    }

    /**
     * 查询指定配置
     *
     * @param int $id
     *
     * @return Conf|null
     */
    public static function findByOne($id = 1)
    {
        return static::findOne( [ 'id' => $id ] );
    }

}
