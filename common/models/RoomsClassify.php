<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_rooms_classify".
 *
 * @property int    $id
 * @property string $c_key       分类KEY
 * @property string $sort_id     排序
 * @property string $name        房间名称
 * @property string $description 描述
 * @property string $keywords    关键字
 * @property string $json_data   Json 数据
 * @property string $parent_id   父类ID
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class RoomsClassify extends \yii\db\ActiveRecord
{

    public static $parentId = 'C0';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms_classify';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['sort_id', 'created_at', 'updated_at'], 'integer'],
            [['description', 'is_using'], 'string'],
            [['c_key', 'keywords', 'json_data', 'parent_id'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 85],
            [['c_key'], 'unique'],
            [['name'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['sort_id'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'c_key'       => '分类关键KEY',
            'sort_id'     => '排序 ID',
            'name'        => '分类名称',
            'description' => '分类描述',
            'keywords'    => '分类关键词',
            'json_data'   => 'Json 数据',
            'parent_id'   => '父类分类',
            'is_using'    => '审核状态',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    public static function findByAll($status = null, $pid = null)
    {

        // 审核状态
        $array = !empty($status) ? ['is_using' => $status] : ['!=', 'is_using', ''];

        $pid = empty($pid) ? static::$parentId : $pid;

        return static::find()->where($array)->andWhere(['parent_id' => $pid])
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

        $result = static::findWhereClassify($pid);

        if (empty($result)) {
            return $result;
        }

        $data = static::findByAll(null, $pid);

        if (empty($data)) {
            return $result;
        }

        // 转换字符串类型
        $result = $result->toArray();

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
            $result[static::$parentId] = '父级分类 !!';

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
