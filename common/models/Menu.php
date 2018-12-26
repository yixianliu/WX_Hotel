<?php

/**
 * @abstract 菜单模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Menu extends ActiveRecord
{

    static public $parent_id = 'M0';

    static public $frontend_parent_id = 'H1';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Menu}}';
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
            [['m_key', 'name', 'parent_id', 'model_key'], 'required'],
            [['is_using', 'rp_key'], 'string'],
            [['sort_id',], 'integer'],
            [['m_key', 'parent_id'], 'string', 'max' => 55],
            [['rp_key', 'model_key', 'name'], 'string', 'max' => 85],
            [['m_key'], 'unique'],

            // 默认
            [['custom_key', 'url', 'rp_key', 'is_type',], 'default', 'value' => null],
            [['is_using',], 'default', 'value' => 'On'],
            [['rp_key',], 'default', 'value' => 'guest'],
            [['sort_id',], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'm_key'      => '菜单关键KEY',
            'is_type'    => '菜单类型',
            'sort_id'    => '菜单排序',
            'parent_id'  => '父类菜单',
            'rp_key'     => '角色关键KEY',
            'model_key'  => '菜单模型',
            'name'       => '菜单名称',
            'url'        => '菜单外部链接',
            'is_using'   => '是否启用',
            'custom_key' => '自定义页面分类KEY',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

    /**
     * 列表
     *
     * @param null   $parent
     * @param string $relevance
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findByAll($parent = null, $relevance = 'Off')
    {

        $parent = empty( $parent ) ? static::$frontend_parent_id : $parent;

        if ($relevance == 'On')
            return static::find()->where( ['is_using' => 'On', 'parent_id' => $parent] )->asArray()->all();

        return static::find()->where( [self::tableName() . '.is_using' => 'On', self::tableName() . '.parent_id' => $parent] )
            ->orderBy( 'sort_id', 'ASC' )
            ->joinWith( 'role' )
            ->joinWith( 'menuModel' )
            ->asArray()
            ->all();
    }

    /**
     * 查找指定菜单
     *
     * @param        $id
     * @param string $relevance
     *
     * @return array|bool|Menu|null|\yii\db\ActiveRecord
     */
    public static function findByOne($id = 1, $relevance = 'Off')
    {

        if (empty( $id ))
            return false;

        if ($relevance == 'On')
            return static::find()->where( ['is_using' => 'On', 'm_key' => $id] )->asArray()->one();

        return static::find()->where( [self::tableName() . '.m_key' => $id] )
            ->joinWith( 'role' )
            ->joinWith( 'menuModel' )
            ->asArray()
            ->one();

    }

    // 菜单模型
    public function getMenuModel()
    {
        return $this->hasOne( MenuModel::className(), ['url_key' => 'model_key'] );
    }

    // 角色
    public function getRole()
    {
        return $this->hasOne( Role::className(), ['r_key' => 'r_key'] );
    }

    /**
     * 获取菜单内容
     *
     * @param        $parent_id
     * @param string $htmlStatus
     * @param array  $styleClass
     *
     * @return array|bool|null|string|ActiveRecord[]
     */
    public static function getParentMenu($parent_id, $htmlStatus = 'Off', $styleClass = [])
    {

        if (empty( $parent_id ))
            return false;

        $result = static::findByAll( $parent_id );

        if (empty( $result ))
            return [];

        foreach ($result as $value) {
            $result[] = static::recursionMenu( $value );
        }

        if ($htmlStatus == 'On') {
            return static::htmlLoad( $result, null, $styleClass );
        }

        return $result;
    }

    /**
     * 递归处理菜单
     *
     * @param $child
     *
     * @return array|void|ActiveRecord[]
     */
    public static function recursionMenu($child)
    {
        if (empty( $child ) || empty( $child['m_key'] ))
            return;

        // 子分类
        $result = static::findByAll( $child['m_key'] );

        if (empty( $result ))
            return;

        // 循环子分类
        foreach ($result as $key => $value) {

            if ($value['menuModel']['is_classify'] === 'On') {

                $modelName = ucwords( $value['menuModel']['url_key'] );

                $child['child'][] = $modelName::findAll( ['is_using' => 'On'] )->toArray();

            } else if (!empty( $value ) && (empty( $value['menuModel']['is_classify'] ) || $value['menuModel']['is_classify'] != 'On')) {

                $parent = static::findByAll( $value['m_key'] );

                if (empty( $parent ))
                    continue;

                $child['child'][] = static::recursionMenu( $parent );
            }

        }

        return $child;
    }

    /**
     * 递归处理载入Html内容
     *
     * @param       $result
     * @param null  $html
     * @param array $styleClass
     *
     * @return array|null|string
     */
    public static function htmlLoad($result, $html = null, $styleClass = [])
    {

        if (empty( $result ))
            return null;

        if (empty( $styleClass )) {
            $styleClass = [
                'liClass' => null,
                'aClass'  => null,
                'ulClass' => null,
            ];
        }

        foreach ($result as $key => $value) {

            if (empty( $value['name'] )) {
                continue;
            }

            $html .= '<li class="' . $styleClass['liClass'] . '">';

            $html .= '  <a href="" title="" class="' . $styleClass['aClass'] . '">' . $value['name'] . '</a>';

            if (!empty( $value['child'] )) {
                $html .= '  <ul class="' . $styleClass['ulClass'] . '">';
                $html .= static::htmlLoad( $value['child'], $html, $styleClass );
                $html .= '  </ul>';
            }

            $html .= '</li>';

        }

        return $html;
    }

    /**
     * 菜单 (选项框使用)
     *
     * @param null $parent_id
     *
     * @return array
     */
    public static function getSelectMenu($parent_id = null)
    {

        $parent_id = empty( $parent_id ) ? static::$parent_id : $parent_id;

        // 产品分类
        $dataClassify = static::findByAll( $parent_id, Yii::$app->session['language'] );

        // 初始化
        $result = [];

        $result['E1'] = '一级菜单';

        foreach ($dataClassify as $key => $value) {

            $result[ $value['m_key'] ] = $value['name'];

            $child = static::recursionMenuSelect( $value );

            if (empty( $child ))
                continue;

            $result = array_merge( $result, $child );
        }

        return $result;
    }

    /**
     * 菜单选择(针对选项框)
     *
     * @param     $data
     * @param int $num
     *
     * @return array|void
     */
    public static function recursionMenuSelect($data, $num = 1)
    {

        if (empty( $data ))
            return;

        // 初始化
        $result = [];
        $symbol = null;

        $child = static::findByAll( $data['m_key'] );

        if (empty( $child ))
            return;

        if ($num != 0) {
            for ($i = 0; $i <= $num; $i++) {
                $symbol .= '――――';
            }
        }

        foreach ($child as $key => $value) {

            $result[ $value['m_key'] ] = $symbol . $value['name'];

            $childData = static::recursionMenuSelect( $value, ($num + 1) );

            if (empty( $childData ))
                continue;

            $result = array_merge( $result, $childData );

        }

        return $result;
    }

}
