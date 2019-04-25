<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_mp_conf".
 *
 * @property int    $id
 * @property string $conf_id    设置关键 Key
 * @property string $name       配置名称
 * @property string $app_id     公众号 appid
 * @property string $app_secret 公众号 app_secret
 * @property string $is_using   是否启用
 * @property string $is_working 是否使用该公众号为工作项
 * @property int    $created_at
 * @property int    $updated_at
 */
class MpConf extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_mp_conf';
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
            [['name', 'app_id', 'app_secret'], 'required'],
            [['conf_id', 'is_using', 'is_working'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['conf_id', 'name', 'app_id'], 'string', 'max' => 85],
            [['app_secret'], 'string', 'max' => 125],
            [['name'], 'unique'],
            [['conf_id'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
            [['is_working'], 'default', 'value' => 'Off'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'conf_id'    => '配置关键 KEY',
            'name'       => '配置名称',
            'app_id'     => 'App ID',
            'app_secret' => 'App Secret',
            'is_using'   => '审核状态',
            'is_working' => '是否为工作项',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }
}
