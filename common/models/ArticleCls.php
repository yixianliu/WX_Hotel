<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

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
    public static function findByAll($status = 'On', $pid = null)
    {

        // 审核状态
        $array = !empty( $status ) ? ['is_using' => $status] : ['!=', 'is_using', ''];

        $pid = empty( $pid ) ? static::$parentId : $pid;

        return static::find()->where( $array )
            ->andWhere( [self::tableName() . '.parent_id' => $pid] )
            ->asArray()
            ->all();
    }

    /**
     * 获取分类 (页面版本)
     *
     * @param string $htmlStatus
     * @param null   $styleClass
     *
     * @return array|string|void|null
     */
    public static function getCls($htmlStatus = 'On', $styleClass = [])
    {

        $result = static::findByAll( 'On', static::$parentId );

        if (empty( $result ))
            return;

        $data = [];

        foreach ($result as $key => $value) {

            $data[ $key ] = $value;

            // 赋值
            $childValue = static::recursionCls( $value );

            if (empty( $childValue['child'] ))
                continue;

            $data[ $key ]['child'][] = $childValue;
        }

        if ($htmlStatus === 'On') {

            // 样式
            $styleClass = [
                'ulClass' => empty( $styleClass['ulClass'] ) ? null : $styleClass['ulClass'],
                'liClass' => empty( $styleClass['liClass'] ) ? null : $styleClass['liClass'],
                'aClass'  => empty( $styleClass['aClass'] ) ? null : $styleClass['aClass'],
            ];

            return static::HtmlShowList( $data, $styleClass );
        }

        return $data;
    }

    /**
     * 递归处理
     *
     * @param null $child
     *
     * @return bool|null
     */
    public static function recursionCls($child = null)
    {
        if (empty( $child ) || empty( $child['c_key'] ))
            return false;

        // 子分类
        $result = static::findByAll( 'On', $child['c_key'] );

        if (empty( $result )) {
            return $child;
        }

        // 循环子分类
        foreach ($result as $key => $value) {

            if (empty( $value ))
                continue;

            // 赋值
            $childValue = static::recursionCls( $value );

            if (empty( $childValue ))
                continue;

            $child['child'][] = $childValue;

        }

        return $child;
    }

    /**
     * 分类Html模式展示
     *
     * @param       $child
     * @param array $styleClass
     *
     * @return string|void|null
     */
    public static function HtmlShowList($child, $styleClass = [])
    {

        if (empty( $child )) {
            return;
        }

        $html = null;

        foreach ($child as $value) {

            if (empty( $value ) || empty( $value['name'] ))
                continue;

            $html .= '<li class="' . $styleClass['liClass'] . '">';

            $html .= '<span>';
            $html .= Html::a( $value['name'], [''], ['class' => $styleClass['aClass']] );
            $html .= '</span>';

            $html .= ' / ' . Html::a( '编辑', ['edit', 'id' => $value['id']] );
            $html .= ' / ' . Html::a( '添加子类', ['edit', 'id' => $value['id']] );

            if (!empty( $value['child'] )) {

                $html .= '<ul class="' . $styleClass['ulClass'] . '">';
                $html .= static::HtmlShowList( $value['child'], $styleClass );
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
