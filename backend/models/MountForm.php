<?php

/**
 * @abstract 安装模型
 * @author Yxl <zccem@163.com>
 */

namespace backend\models;

use Yii;
use yii\base\Model;

class MountForm extends Model
{

    public $username;
    public $password;
    public $dbname;
    public $dbhost;
    public $dbuser;

    /**
     * @abstract 验证规则
     * @inheritdoc
     */
    public function rules()
    {

        return [

            // 登录
            [['username', 'password'], 'required', 'on' => ['login']],

            // 挂载
            [['dbname', 'dbhost', 'dbuser'], 'required', 'on' => ['install']],
        ];
    }

    /**
     * 场景
     *
     * @return array
     */
    public function scenarios()
    {
        return [
            'login'  => ['username', 'password'],
            'intall' => ['dbname', 'dbhost', 'dbuser'],
        ];
    }

    /**
     * @abstract 指定属性标签
     */
    public function attributeLabels()
    {
        return [
            'username' => '帐号',
            'password' => '密码',
            'dbname'   => '数据库名称',
            'dbhost'   => '数据库主机',
            'dbuser'   => '数据库帐号',
        ];
    }

    /**
     * @abstract 挂载登录
     */
    public function mLogin()
    {

        if ($this->username != Yii::getAlias('@Username') || !Yii::$app->security->validatePassword($this->password, Yii::getAlias('@Password'))) {
            return false;
        }

        return true;
    }

}
