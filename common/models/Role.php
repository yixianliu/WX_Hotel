<?php

/**
 * @abstract 版块模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Role extends ActiveRecord
{

    public $p_key;

    public static $defaultRole = 'R11';

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%role}}';
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
            [['description', 'name'], 'required'],
            [['description'], 'string', 'length' => [15, 10500]],
            [['name', 'r_key',], 'string', 'length' => [2, 55]],

            [['is_using',], 'default', 'value' => 'On'],
            [['sort_id', 'exp'], 'default', 'value' => 1],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'name'        => '角色名称',
            'description' => '角色描述',
            'r_key'       => '角色关键KEY',
            'p_key'       => '权限组',
            'is_using'    => '开启角色',
            'sort_id'     => '角色排序',
            'exp'         => '角色经验',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 查找角色
     *
     * @param $id
     *
     * @return array|ActiveRecord[]
     */
    public static function findByData($id)
    {
        return static::find()->where( ['r_key' => $id] )->one();
    }

    /**
     * 分页
     *
     * @param int  $limit
     * @param null $status
     *
     * @return $this
     */
    public static function findByRole($limit = 15, $status = null)
    {

        $array = !empty( $status ) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        return static::find()->select( self::tableName() . ".*" )
            ->where( $array )
            ->orderBy( self::tableName() . '.sort_id' )
            ->limit( $limit )
            ->all();
    }

    /**
     * 所有角色
     *
     * @param null $status
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null)
    {

        $array = !empty( $status ) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        return static::find()->select( self::tableName() . ".*" )
            ->where( $array )
            ->orderBy( self::tableName() . '.sort_id' )
            ->asArray()
            ->all();
    }

    /**
     * 查询指定角色
     *
     * @param int $id
     *
     * @return array|AuthRole|null|\yii\db\ActiveRecord
     */
    public static function findByOne($id = 1)
    {
        return static::find()->where( ['id' => $id] )->one();
    }

    public static function Reorganize()
    {

    }

    /**
     * 获取角色(选项卡版本)
     *
     * @return array
     */
    public static function getRoleSelect()
    {
        // 初始化
        $data = [];

        $result = static::findByAll();

        foreach ($result as $value) {
            $data[ $value['r_key'] ] = $value['name'];
        }

        return $data;
    }

}
