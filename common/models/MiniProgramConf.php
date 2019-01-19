<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_mini_program_conf".
 *
 * @property int $id
 * @property string $weixin_id 微信 Id
 * @property string $app_id 小程序 Id
 * @property string $mch_id 商户号 Id
 * @property string $api_psw API密钥
 * @property string $cert_path 证书路径
 * @property string $cert_psw 证书密码
 * @property string $is_using 是否启用
 * @property int $created_at
 * @property int $updated_at
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
            [['weixin_id', 'app_id', 'mch_id', 'api_psw', 'cert_path', 'cert_psw', 'is_using'], 'required'],
            [['is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['weixin_id', 'app_id', 'mch_id', 'api_psw', 'cert_path', 'cert_psw'], 'string', 'max' => 85],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'weixin_id' => '微信 Id',
            'app_id' => '小程序 Id',
            'mch_id' => '商户号 Id',
            'api_psw' => 'API密钥',
            'cert_path' => '证书路径',
            'cert_psw' => '证书密码',
            'is_using' => '是否启用',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
