<?php

/**
 * @abstract 登录控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers\mount;

use Yii;
use backend\models\MountForm;
use yii\helpers\Json;

class MemberController extends BaseController
{

    public $layout = false;

    /**
     * @abstract 登录
     */
    public function actionLogin()
    {

        $data = Yii::$app->session->get( 'MountAdmin' );

        if (!empty( $data['username'] ) && ($data['username'] == Yii::getAlias( '@Username' )))
            $this->redirect( ['/mount/center/view'] );

        $model = new MountForm();

        return $this->render( '../login', ['model' => $model] );
    }

    /**
     * @abstract 判断
     */
    public function actionIn()
    {

        $request = Yii::$app->request;

        if (!$request->isAjax) {
            return $this->redirect( ['/mount/center/view'] );
        }

        $model = new MountForm();

        $model->scenario = 'login';

        if (!$model->load( $request->post() ) || !$model->validate()) {

            // 使用 $model->getErrors() 获取错误详情
            return Json::encode( $model->getErrors() );
        }

        if (!$model->mLogin()) {
            return Json::encode( ['msg' => '帐号密码异常,请检查 !!'] );
        }

        $array = [
            'username'   => $request->post( 'MountForm' )['username'],
            'login_time' => time(),
        ];

        // Session
        Yii::$app->session->set( 'MountAdmin', $array );

        return Json::encode( ['msg' => '登录成功 !!', 'status' => true] );
    }

    /**
     * @abstract 注销
     */
    public function actionLogout()
    {

        $session = Yii::$app->session;

        $session->set( 'MountAdmin', [] );

        $session->close();
        $session->destroy();

        return $this->redirect( ['/mount/member/login'] );
    }

}
