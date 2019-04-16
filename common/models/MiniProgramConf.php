<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_mini_program_conf".
 *
 * @property int    $id
 * @property string $wx_id     微信 Id
 * @property string $app_id    小程序 Id
 * @property string $mch_id    商户号 Id
 * @property string $api_psw   API密钥
 * @property string $cert_path 证书路径
 * @property string $cert_psw  证书密码
 * @property string $is_using  是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class MiniProgramConf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_mini_program_conf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'app_id', 'mch_id', 'api_psw', 'cert_path', 'key_path', 'cert_psw'], 'required'],
            [['is_using', 'conf_id'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'app_id', 'mch_id', 'api_psw', 'cert_psw'], 'string', 'max' => 85],
            [['cert_path', 'key_path'], 'string', 'max' => 300],

            [['is_using'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'conf_id'    => '配置关键 Key',
            'name'       => '配置名称',
            'app_id'     => '小程序 Id',
            'mch_id'     => '商户号 Id',
            'api_psw'    => 'API密钥',
            'cert_path'  => 'CERT 证书路径',
            'key_path'   => 'KEY 证书路径',
            'cert_psw'   => '证书密码',
            'is_using'   => '是否启用',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }
}
