<?php

/**
 * @abstract 产品模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class ProductClassify extends ActiveRecord
{

    public static $parentId = 'C0';

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%product_classify}}';
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
            [['name', 'parent_id'], 'required'],
            [['c_key', 'name'], 'string', 'max' => 80],
            [['keywords'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 5000],

            [['sort_id'], 'default', 'value' => 1],
            [['is_using'], 'default', 'value' => 'On'],
            [['keywords', 'description'], 'default', 'value' => null],
        ];
    }

    /**
     * @abstract 标签
     * @return type
     */
    public function attributeLabels()
    {

        return [
            'name'        => '分类名称',
            'parent_id'   => '父级分类',
            'c_key'       => '分类关键KEY',
            'sort_id'     => '分类排序',
            'keywords'    => '分类关键词',
            'json_data'   => 'Json 数据',
            'description' => '分类描述',
            'is_using'    => '审核状态',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 产品分类
     *
     * @param null $status
     * @param null $pid
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null, $pid = null)
    {

        // 审核状态
        $array = !empty($status) ? ['is_using' => $status] : ['!=', 'is_using', ''];

        $pid = empty($pid) ? static::$parentId : $pid;

        return static::find()->where($array)
            ->andWhere([self::tableName() . '.parent_id' => $pid])
            ->asArray()
            ->all();
    }

    /**
     * 查找版块
     *
     * @param $id
     *
     * @return array|ProductClassify|null|ActiveRecord
     */
    public static function findWhereClassify($id)
    {

        return static::find()->where(['is_using' => 'On', 'c_key' => $id])->one();
    }

    /**
     * 指定产品分类
     *
     * @param string $id
     */
    public static function findById($id)
    {
        return static::find()->where(['is_using' => 'On', 'c_key' => $id])->asArray()->one();
    }

    /**
     * @abstract 获取产品的登记
     */
    public function getProduct()
    {
        return $this->hasOne(Product1::className(), ['c_key' => 'c_key']);
    }

    /**
     * @abstract 获取用户的所有产品
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['r_key' => 'r_key']);
    }

    /**
     * 递归处理
     *
     * @param      $pid
     * @param null $one
     *
     * @return array|ProductClassify|null|void|ActiveRecord
     */
    public static function recursionData($pid)
    {

        if (empty($pid))
            return;

        $result = static::findWhereClassify($pid)->toArray();

        if (empty($result)) {
            return $result;
        }

        $data = static::findByAll(null, $pid);

        if (empty($data)) {
            return $result;
        }

        foreach ($data as $key => $value) {
            $result['child'][] = static::recursionData($value['c_key']);
        }

        return $result;
    }

    /**
     * 获取分类(选项框)
     *
     * @param string $one
     *
     * @return array
     */
    public static function getClsSelect($one = 'On')
    {

        // 初始化
        $result = [];

        // 产品分类
        $dataClassify = static::findByAll('On', static::$parentId);

        if ($one == 'On')
            $result[static::$parentId] = '顶级分类 !!';

        foreach ($dataClassify as $key => $value) {

            $result[$value['c_key']] = $value['name'];

            $child = static::recursionClsSelect($value);

            if (empty($child))
                continue;

            $result = array_merge($result, $child);
        }

        return $result;
    }

    /**
     * 无限分类(选项框)
     *
     * @param     $data
     * @param int $num
     *
     * @return array|void
     */
    public static function recursionClsSelect($data, $num = 1)
    {

        if (empty($data))
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

}
