<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_conf".
 *
 * @property int    $id
 * @property string $language    配置语言
 * @property string $name        网站名称
 * @property string $title       网站标题
 * @property string $email       网站联系邮箱
 * @property string $phone       网站联系电话
 * @property string $keywords    网站关键词
 * @property string $site_url    网站URL地址
 * @property string $developers  开发者
 * @property string $icp         备案号
 * @property string $description 网站描述
 * @property string $copyright   字段值
 * @property int    $created_at
 * @property int    $updated_at
 */
class Conf extends \yii\db\ActiveRecord
{

    public static $defaultId = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_conf';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
            [['name', 'title', 'site_url'], 'required'],
            [['developers', 'keywords', 'email', 'phone', 'lang_key', 'description', 'copyright', 'icp'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['lang_key', 'name'], 'string', 'max' => 85],
            [['title', 'email', 'phone', 'keywords', 'site_url', 'developers', 'icp', 'copyright'], 'string', 'max' => 135],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lang_key'    => '配置语言',
            'name'        => '网站名称',
            'title'       => '网站标题',
            'email'       => '网站联系邮箱',
            'phone'       => '网站联系电话',
            'keywords'    => '网站关键词',
            'site_url'    => '网站URL地址',
            'developers'  => '开发者',
            'icp'         => '备案号',
            'description' => '网站描述',
            'copyright'   => '版本',
            'created_at'  => '添加数据时间',
            'updated_at'  => '更新数据时间',
        ];
    }

    /**
     * 查询指定
     *
     * @param int $id
     *
     * @return array|AuthRole|null|\yii\db\ActiveRecord
     */
    public static function findByOne($id = null)
    {

        $id = empty($id) ? static::$defaultId : $id;

        return static::find()->where(['id' => $id])->one();
    }

}
