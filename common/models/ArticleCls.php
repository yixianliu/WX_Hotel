<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_article_cls".
 *
 * @property int    $id
 * @property string $c_key       分类KEY
 * @property string $sort_id     排序
 * @property string $name        名称
 * @property string $description 描述
 * @property string $keywords    关键字
 * @property string $json_data   Json 数据
 * @property string $parent_id   父类ID
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class ArticleCls extends \yii\db\ActiveRecord
{

    public static $parentId = 'C0';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_article_cls';
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
            [['c_key', 'name', 'parent_id'], 'required'],
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
            'c_key'       => '分类KEY',
            'sort_id'     => '排序',
            'name'        => '名称',
            'description' => '描述',
            'keywords'    => '关键字',
            'json_data'   => 'Json 数据',
            'parent_id'   => '父类ID',
            'is_using'    => '是否启用',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 文章分类
     *
     * @param null $status
     * @param null $pid
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null, $pid = null)
    {

        // 审核状态
        $array = !empty( $status ) ? ['is_using' => $status] : ['!=', 'is_using', ''];

        $pid = empty( $pid ) ? static::$parentId : $pid;

        return static::find()->where( $array )
            ->andWhere( [self::tableName() . '.parent_id' => $pid] )
            ->asArray()
            ->all();
    }

    public static function getCls($htmlStatus = 'On')
    {
        $result = static::findByAll( static::$parentId );

        if (empty( $result ))
            return [];

        $data = [];

        foreach ($result as $value) {
            $data[] = static::recursionCls( $value );
        }

        if ($htmlStatus === 'On') {
            return static::htmlAdminLoad( $data );
        }

        return $data;
    }

    public static function recursionCls()
    {

    }

    public static function HtmlShowList($child, $styleClass = [])
    {

        if (empty( $child ) || empty( $child['c_key'] )) {
            return;
        }

        // 样式
        if (empty( $styleClass )) {
            $styleClass = [
                'ulClass' => 'list-group',
                'liClass' => 'list-group-item',
                'aClass'  => '',
            ];
        }

        $html = null;

        foreach ($child as $value) {

            $html .= '<li class="' . $styleClass['liClass'] . '">';

            $html .= '  <a href="">' . $value['name'] . '</a>';

            if (!empty( $value['child'] )) {

                $html .= '<ul class="list-group border-bottom">';
                $html .= static::htmlAdminLoad( $value['child'], $styleClass );
                $html .= '</ul>';

            }
            $html .= '</li>';

        }

        return $html;
    }

    /**
     * 获取分类(选项框)
     *
     * @param string $one
     * @param string $status
     *
     * @return array
     */
    public static function getClsSelect($one = 'On', $status = 'On')
    {

        // 初始化
        $result = [];

        // 产品分类
        $dataClassify = static::findByAll( $status, static::$parentId );

        if ($one == 'On')
            $result[ static::$parentId ] = '顶级分类 !!';

        foreach ($dataClassify as $key => $value) {

            $result[ $value['c_key'] ] = $value['name'];

            $child = static::recursionClsSelect( $value );

            if (empty( $child ))
                continue;

            $result = array_merge( $result, $child );
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

        if (empty( $data ))
            return;

        // 初始化
        $result = [];
        $symbol = null;

        $child = static::findByAll( null, $data['c_key'] );

        if (empty( $child ))
            return;

        if ($num != 0) {
            for ($i = 0; $i <= $num; $i++) {
                $symbol .= '――';
            }
        }

        foreach ($child as $key => $value) {

            $result[ $value['c_key'] ] = $symbol . $value['name'];

            $childData = static::recursionClsSelect( $value, ($num + 1) );

            if (empty( $childData ))
                continue;

            $result = array_merge( $result, $childData );
        }

        return $result;
    }
}
