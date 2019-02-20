<?php

namespace frontend\models;


use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Role;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $user_id;
    public $username;
    public $telphone;
    public $password;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'telphone', 'user_id'], 'required'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已被占用.'],
            ['telphone', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机已被占用.'],

            ['username', 'string', 'min' => 4, 'max' => 55],

            ['telphone', 'string', 'min' => 11, 'max' => 11],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'username'    => '用户名称',
            'telphone'    => '手机号码',
            'password'    => '密码',
            're_password' => '确认密码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->validate()) {
            return false;
        }

        $user = new User();

        $user->user_id = $this->user_id;
        $user->username = $this->username;
        $user->telphone = $this->telphone;
        $user->r_key = Role::$defaultRole;
        $user->reg_time = time();
        $user->last_login_time = time();
        $user->login_ip = Yii::$app->request->userIP;
        $user->is_using = 'Not';

        $user->setPassword( $this->password );

        $user->generateAuthKey();

        return $user->save( false ) ? $user : null;
    }
}
