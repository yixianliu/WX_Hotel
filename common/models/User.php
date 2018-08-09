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

            [['username', 'r_key',], 'required'],
            [['r_key', 'nickname',], 'string'],

            // 默认
            [['nickname',], 'default', 'value' => null],
            [['is_microhurt', 'is_head',], 'default', 'value' => 'Off'],
            [['is_display',], 'default', 'value' => 'On'],
            [['is_using',], 'default', 'value' => 'Not'],
            [['r_key',], 'default', 'value' => 'R15'],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'user_id'    => '用户 Id',
            'username'   => '用户名称',
            'r_key'      => '角色',
            'reg_time'   => '注册时间',
            'is_using'   => '审核状态',
            'nickname'   => '昵称',
            'rePassword' => '二次密码',
            'birthday'   => '出生年月日',
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
        return static::find()->select(Role::tableName() . ".name as rname, " . self::tableName() . ".*, ")
            ->joinWith('role')
            ->where([self::tableName() . '.id' => $id])
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
        return static::find()->where(['username' => $username]);
    }

    /**
     * @inheritdoc 登录会调用
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
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
        $this->password = Yii::$app->security->generatePasswordHash($password);
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
        $array = !empty($status) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        return static::find()->where($array)
            ->joinWith('role')
            ->orderBy(self::tableName() . '.user_id')
            ->all();
    }

    /**
     * @abstract 获取产品的等级
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['r_key' => 'r_key']);
    }

}
