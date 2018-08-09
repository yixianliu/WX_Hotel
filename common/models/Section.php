<?php

/**
 * @abstract 版块模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Section extends ActiveRecord
{

    public static $parentId = 'S0';

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%section}}';
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

            [['name'], 'required'],

            ['name', 'string', 'length' => [4, 50]],
            ['description', 'string', 'length' => [15, 5000]],
            ['keywords', 'string', 'length' => [5, 150]],

            [['is_using',], 'default', 'value' => 'On'],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'name'        => '版块名称',
            'description' => '版块描述',
            'keywords'    => '关键词',
            's_key'       => '版块关键KEY',
            'description' => '版块描述',
        ];
    }

    /**
     * 所有
     *
     * @param null $status
     * @param null $pid
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null, $pid = null)
    {

        $pid = empty($pid) ? static::$parentId : $pid;

        // 审核状态
        $array = !empty($status) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        // 父类ID
        $arrayPid = [self::tableName() . '.parent_id' => $pid];

        return static::find()->where($array)
            ->andWhere($arrayPid)
            ->asArray()
            ->all();
    }

    /**
     * 查找版块
     *
     * @param $id
     *
     * @return array|Section|null|ActiveRecord
     */
    public static function findWhereData($id)
    {

        return static::find()->where([self::tableName() . '.is_using' => 'On', self::tableName() . '.s_key' => $id])
            ->asArray()
            ->one();
    }

    /**
     * 循环版块 (选项卡)
     *
     * @param null $activeId
     *
     * @return array
     */
    public static function GetSelectData($activeId = null)
    {

        $dataCls = static::recursionData();

        if (empty($dataCls))
            return false;

        foreach ($dataCls as $value) {

            if ($value['s_key'] == $activeId) {

            }

            $result = '';

        }

        return $result;
    }

    /**
     * 无限分类(选项框)
     *
     * @param     $data
     * @param int $num
     */
    public static function recursionClsSelect($data, $num = 1)
    {

        if (empty($data) || !is_array($data))
            return;

        // 初始化
        $result = [];
        $symbol = null;

        $child = static::findByAll($data['c_key']);

        if (empty($child))
            return;

        if ($num != 0) {
            for ($i = 0; $i <= $num; $i++) {
                $symbol .= '――';
            }
        }

        foreach ($child as $key => $value) {

            $result[$value['c_key']] = $symbol . $value['name'];

            $childData = static::recursionClsSelect($value, ($num + 1));

            if (empty($childData))
                continue;

            $result = array_merge($result, $childData);
        }

        return $result;
    }

    /**
     * 递归处理
     *
     * @param null   $pid
     * @param string $status
     *
     * @return array|bool|Section|null|void|ActiveRecord
     */
    public static function recursionData($pid = null, $status = 'On')
    {

        $pid = empty($pid) ? static::$parentId : $pid;

        // 不是 顶级父类 (S0)
        if ($pid != static::$parentId) {

            $result = static::findWhereData($pid);

            if (empty($result))
                return;

            $data = static::findByAll($status, $pid);

            if (empty($data))
                return $result;

            foreach ($data as $key => $value) {
                $result['child'][] = static::recursionData($value['s_key']);
            }

        } else {

            $data = static::findByAll($status, $pid);

            if (empty($data))
                return false;

            foreach ($data as $key => $value) {
                $result[] = static::recursionData($value['s_key']);
            }

        }

        return $result;
    }

}
