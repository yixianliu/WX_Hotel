<?php

namespace frontend\models;

use common\models\Role;
use Yii;
use frontend\controllers\BaseController;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
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
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已被占用.'],
            ['username', 'string', 'min' => 2, 'max' => 55],

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
            're_password' => '二次密码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if ( !$this->validate() ) {
            return null;
        }

        $user = new User();

        $user->username = $this->username;
        $user->telphone = $this->telphone;

        $user->user_id = BaseController::getRandomString();

        $user->r_key = Role::$defaultRole;
        $user->reg_time = time();
        $user->last_login_time = time();
        $user->login_ip = Yii::$app->request->userIP;
        $user->is_using = 'Not';

        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save(false) ? $user : null;
    }
}
