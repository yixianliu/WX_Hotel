<?php
/**
 *
 * API - 获取支付配置
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/25
 * Time: 17:10
 */

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class ApiConnController extends ApiBaseController
{

    public $enableCsrfValidation = false;

    /**
     * 微信链接(普通版本)
     *
     * @return array|bool
     */
    public function actionIndex()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isAjax) {
            return ['msg' => '状态异常!' . Yii::$app->request->post( 'appid', null ), 'status' => false];
        }

        return ['msg' => '连接成功!', 'status' => true];
    }

    /**
     * 获取用户 Open_id
     *
     * @return array|bool
     */
    public function actionWxUser()
    {

        if (!Yii::$app->request->isAjax) {
            return false;
        }

        $code = Yii::$app->request->get( 'code', null );

        // Api接口
        $ApiUrl = "https://api.weixin.qq.com/sns/jscode2session?appid=" . static::$MpConnData['appid'] . "&secret=" . static::$MpConnData['appscret'] . "&js_code={$code}&grant_type=authorization_code";

        $curl = curl_init();

        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_TIMEOUT, 500 );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, true );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, true );
        curl_setopt( $curl, CURLOPT_URL, $ApiUrl );

        /*
         *  "openid": "OPENID",
         *  "session_key": "SESSIONKEY",
         *  "unionid": "UNIONID",
         */
        $data = curl_exec( $curl );

        curl_close( $curl );

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['msg' => 'ok', 'data' => $data, 'status' => true];
    }

    /**
     * 微信链接 (证书版本)
     *
     * @return array|bool
     */
    public function actionWxConnKey()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;

        if (
            !Yii::$app->request->isAjax ||
            $session->isActive ||
            empty( $session['conn']['appid'] ) ||
            empty( $session['conn']['mch_id'] ) ||
            empty( $session['conn']['mch_api_psd'] ) ||
            empty( $session['conn']['SSL_CERT_PATH'] ) ||
            empty( $session['conn']['SSL_KEY_PATH'] ) ||
            !is_file( Yii::getAlias( '@webroot' ) . '/temp/ssl/' . $session['conn']['SSL_CERT_PATH'] ) ||
            !is_file( Yii::getAlias( '@webroot' ) . '/temp/ssl/' . $session['conn']['SSL_KEY_PATH'] )
        ) {
            return false;
        }

        // WX状态已连接
        $session['conn']['status'] = true;

        return ['msg' => '连接成功!', 'status' => true];
    }
}
