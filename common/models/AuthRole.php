<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_auth_role".
 *
 * @property string $id
 * @property string $name        角色名称
 * @property string $description 权限描述
 * @property string $rule_name   规则
 * @property string $data        数据
 * @property int    $type        状态 1：角色 2：权限
 * @property int    $status      状态 1：有效 0：无效
 * @property int    $updated_at  最后一次更新时间
 * @property int    $created_at  插入时间
 */
class AuthRole extends \yii\db\ActiveRecord
{

    public $p_key;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_auth_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status', 'name'], 'required'],
            [['type', 'status',], 'integer'],
            [['name', 'description', 'rule_name', 'data'], 'string', 'max' => 80],
            [['name'], 'unique'],
            [['description'], 'unique'],

            [['status'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_key'       => '权限组',
            'name'        => '名称',
            'description' => '描述',
            'rule_name'   => '规则名称',
            'data'        => '内容',
            'type'        => '类别',
            'status'      => '状态',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 所有 权限/角色
     *
     * @param null $type
     *
     * @return array|AuthRole[]|Power[]|ProductClassify[]|ProductLevel[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($type = null)
    {
        return static::find()->where( (!empty( $type ) ? ['type' => $type] : ['!=', 'type', 'null']) )->all();
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

    public static function getSelect()
    {
        // 初始化
        $result = [];

        // 产品分类
        $data = static::findByAll( 2 );

        foreach ($data as $key => $value) {
            $result[ $value['name'] ] = $value['description'];
        }

        return $result;
    }
}
