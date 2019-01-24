<?php

/**
 * @abstract 用户模型
 * @author   Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\base\NotSupportedException;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public $auth_key;

    public static $UserDefName = '管理员';

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @abstract 验证规则
     */
    public function rules()
    {

        return [

            [['username', 'r_key', 'password', 'nickname'], 'required'],

            ['username', 'email'],
            [['username', 'nickname'], 'string', 'max' => 30],
            [['r_key', 'birthday', 'user_id', 'password'], 'string', 'max' => 85],
            [['signature', 'address'], 'string', 'max' => 255],
            [['credit'], 'integer'],

            // 默认
            [['birthday', 'signature', 'address'], 'default', 'value' => null],
            [['is_security', 'is_head',], 'default', 'value' => 'Off'],
            [['is_display',], 'default', 'value' => 'On'],
            [['is_using',], 'default', 'value' => 'Not'],
            [['r_key',], 'default', 'value' => Rooms::$defaultRole],

        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'user_id'         => '用户 ID',
            'username'        => '用户名',
            'password'        => '密码',
            'credit'          => '积分',
            'signature'       => '个性签名',
            'address'         => '通讯地址',
            'r_key'           => '角色',
            'nickname'        => '昵称',
            'sex'             => '性别',
            'telphone'        => '手机号码',
            'rePassword'      => '二次密码',
            'birthday'        => '出生年月日',
            'login_ip'        => '登录 IP 地址',
            'is_display'      => '是否显示信息',
            'is_head'         => '是否上传头像',
            'is_security'     => '是否安全设置',
            'is_using'        => '是否可用',
            'last_login_time' => '最后登陆时间',
            'reg_time'        => '注册时间',
        ];
    }

    /**
     * 查找用户ID
     *
     * @param $id
     *
     * @return static
     */
    public static function findById($id)
    {
        return static::find()->select( Role::tableName() . ".name as rname, " . self::tableName() . ".*, " )
            ->joinWith( 'role' )
            ->where( [self::tableName() . '.id' => $id] )
            ->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where( ['username' => $username] );
    }

    /**
     * @inheritdoc 登录会调用
     */
    public static function findIdentity($id)
    {
        return static::findOne( ['id' => $id] );
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException( '"findIdentityByAccessToken" is not implemented.' );
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash( $password );
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * 所有用户
     *
     * @param null $status
     *
     * @return $this
     */
    public static function findByAll($status = null)
    {

        // 审核状态
        $array = !empty( $status ) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        return static::find()->where( $array )
            ->joinWith( 'role' )
            ->orderBy( self::tableName() . '.user_id' )
            ->all();
    }

    /**
     * @abstract 获取产品的等级
     */
    public function getRole()
    {
        return $this->hasOne( Role::className(), ['r_key' => 'r_key'] );
    }

}
