<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_product".
 *
 * @property int    $id
 * @property string $product_id   产品编号,唯一识别码
 * @property string $user_id      用户ID
 * @property string $l_key        等级KEY
 * @property string $c_key        产品分类KEY
 * @property string $s_key        版块KEY,版块默认为S0,意思是没有分配好相关版块.
 * @property string $title        产品标题
 * @property string $content      产品内容
 * @property string $price        一口价
 * @property string $discount     折扣价
 * @property string $introduction 导读,获取产品介绍第一段.
 * @property string $keywords     关键字
 * @property string $path         产品文件路径
 * @property string $praise       赞数量
 * @property string $forward      转发数量
 * @property string $collection   收藏数量
 * @property string $share        分享数量
 * @property string $attention    关注数量
 * @property string $is_promote   推广
 * @property string $is_hot       热门
 * @property string $is_classic   经典
 * @property string $is_winnow    精选
 * @property string $is_recommend 推荐
 * @property string $is_audit     审核
 * @property string $is_field     是否生成字段JSON文件,没有生成的话,产品异常!
 * @property string $is_comments  是否启用评论
 * @property string $is_img       是否上传图片
 * @property string $is_thumb     是否生成缩略图,发布产品可以上传图片,但最后审核通过了,才会生成缩略图
 * @property string $grade        本站评分,由我们网站人员进行评估.
 * @property string $user_grade   用户评分,由本站用户进行评估.
 * @property string $published    发布时间
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%product}}';
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
            [['product_id', 'c_key', 'title', 'content', 'price'], 'required'],
            [['user_id', 'content', 'is_promote', 'is_hot', 'is_classic', 'is_winnow', 'is_recommend', 'is_audit', 'is_field', 'is_comments'], 'string'],
            [['price', 'discount', 'praise', 'forward', 'collection', 'share', 'attention', 'grade', 'user_grade'], 'integer'],
            [['product_id'], 'string', 'max' => 85],
            [['user_id', 'l_key', 'c_key', 's_key', 'path'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['introduction'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 120],
            [['product_id'], 'unique'],
            [['title'], 'unique'],

            [['is_promote', 'is_hot', 'is_classic', 'is_winnow', 'is_recommend',], 'default', 'value' => 'Off'],
            [['l_key'], 'default', 'value' => 'L1'],
            [['grade', 'user_grade'], 'default', 'value' => 1],
            [['s_key',], 'default', 'value' => 'S1'],
            [['is_audit', 'is_field', 'is_comments'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'l_key'        => '产品等级',
            'c_key'        => '产品分类',
            's_key'        => '所属板块',
            'title'        => '产品标题',
            'content'      => '产品内容',
            'price'        => '价格',
            'discount'     => '折扣价',
            'introduction' => '产品导读',
            'keywords'     => '关键词',
            'path'         => '产品路径',
            'thumb'        => '产品缩略图',
            'images'       => '产品图片',
            'praise'       => 'Praise',
            'forward'      => 'Forward',
            'collection'   => 'Collection',
            'share'        => 'Share',
            'attention'    => 'Attention',
            'is_promote'   => '是否开启推广',
            'is_hot'       => '是否开启热门',
            'is_classic'   => '是否开启经典',
            'is_winnow'    => '是否开启精选',
            'is_recommend' => '是否开启推荐',
            'is_audit'     => '审核状态',
            'is_field'     => '生成字段',
            'is_comments'  => '是否开启评论',
            'grade'        => '产品评分',
            'user_grade'   => '用户评分',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }

    /**
     * 产品列表
     *
     * @param string $status
     * @param null   $sKey
     * @param null   $cKey
     * @param string $page
     *
     * @return array|Product[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = 'On', $sKey = null, $cKey = null, $page = 'off')
    {

        // 审核状态
        $array = !empty($status) ? [self::tableName() . '.is_audit' => $status] : ['!=', self::tableName() . '.is_audit', null];

        // 分类
        $cKeyArray = !empty($cKey) ? [self::tableName() . '.c_key' => $cKey] : ['!=', self::tableName() . '.c_key', null];

        if ($page == 'off') {

            // 不能用all(), 用了分页无法使用
            return static::find()->select(User::tableName() . ".username, " . ', ' . self::tableName() . ".*")
                ->joinWith('user')
                ->where($array)
                ->andWhere($cKeyArray)
                ->orderBy([self::tableName() . '.product_id' => SORT_DESC])
                ->asArray()
                ->all();

        }

        return static::find()->select(User::tableName() . ".username, " . ProductLevel::tableName() . '.name as lname, ' . self::tableName() . ".*")
            ->joinWith('user')
            ->where($array)
            ->andWhere($cKeyArray)
            ->orderBy([self::tableName() . '.product_id' => SORT_DESC]);

    }

    /**
     * 查找所属用户产品
     *
     * @param      $id
     * @param null $status
     * @param int  $limit
     *
     * @return array|bool|Product[]|\yii\db\ActiveRecord[]
     */
    public static function findByUserData($id, $status = null, $limit = 10)
    {

        if (empty($id)) {
            return false;
        }

        $status = empty($status) ? 'On' : $status;

        return static::find()->select(User::tableName() . ".*, " . self::tableName() . ".*, " . ProductLevel::tableName() . '.name as lname')
            ->joinWith('user')
            ->joinWith('level')
            ->where([self::tableName() . '.is_audit' => $status, self::tableName() . '.product_id' => $id])
            ->orderBy(self::tableName() . '.product_id')
            ->limit($limit);
    }

    /**
     * @abstract 条件查询产品
     *
     * @param int $id 产品ID
     */
    public static function findWhereProduct($id, $status = null)
    {

        if (empty($id))
            return false;

        $status = empty($status) ? 'On' : $status;

        return static::find()->select(User::tableName() . ".*, " . self::tableName() . ".*, " . ProductLevel::tableName() . '.name as lname')
            ->joinWith('user')
            ->joinWith('level')
            ->where([self::tableName() . '.is_audit' => $status])
            ->andwhere([self::tableName() . '.product_id' => $id])
            ->orderBy(self::tableName() . '.product_id')
            ->asArray()
            ->one();
    }

    /**
     * @abstract 获取用户的所有产品
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @abstract 获取产品的分类
     */
    public function getClassify()
    {
        return $this->hasOne(ProductClassify::className(), ['c_key' => 'c_key']);
    }
}
