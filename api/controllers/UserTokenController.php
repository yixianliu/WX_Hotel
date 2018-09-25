<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/25
 * Time: 16:25
 */
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;

class UserTokenController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionLogin()
    {
        $model = new ApiLoginForm();
    }
}