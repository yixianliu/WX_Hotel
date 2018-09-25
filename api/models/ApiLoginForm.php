<?php
/**
 *
 * 后台登录表单
 *
 * Created by Yixianliu.
 * User: Yxl <zccem@163.com>
 * Date: 2017/6/7
 * Time: 15:30
 */

namespace api\models;

use Yii;
use yii\base\Model;
use common\models\Management as User;

class ApiLoginForm extends Model
{

    public $username;
    public $password;

    private $_user;

    /**
     * 验证规则
     *
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['username', 'password'], 'required'],

            // 对username的值进行两边去空格过滤
            [['username', 'password'], 'filter', 'filter' => 'trim'],

            // string 字符串，这里我们限定的意思就是username至少包含2个字符，最多255个字符
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '帐号',
            'password' => '密码',
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {

        $accessToken = $this->generateAccessToken();

        return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
    }

    public function generateAccessToken()
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {

        if ( $this->_user === false ) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}