<?php
/**
 *
 * 权限模型
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/8/11
 * Time: 9:52
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Power extends ActiveRecord
{

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%power}}';
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
     * @abstract 验证规则
     */
    public function rules()
    {
        return [

            [['name', 'rules',], 'required'],

            // 唯一
            [['name', 'rules', 'p_key'], 'unique'],

            // 默认值
            [['description', 'group'], 'default', 'value' => null],
            [['is_using',], 'default', 'value' => 'On'],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'name'        => '权限名称',
            'p_key'       => '权限关键KEY',
            'rules'       => '权限规则',
            'is_using'    => '权限状态',
            'description' => '权限描述',
            'group'       => '权限分组',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 所有权限
     *
     * @param null $status
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null)
    {

        $array = !empty( $status ) ? ['is_using' => $status] : ['!=', 'is_using', 'null'];

        return static::find()->where( $array )->orderBy( ['id' => SORT_DESC] )->all();
    }

    /**
     * 查找角色
     *
     * @param $id
     *
     * @return array|ActiveRecord[]
     */
    public static function findWherePower($id)
    {
        return static::find()->where( ['p_key' => $id] )->one();
    }

}