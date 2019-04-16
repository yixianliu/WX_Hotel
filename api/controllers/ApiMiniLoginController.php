<?php
/**
 *
 * 小程序登录接口
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/15
 * Time: 15:09
 */

namespace api\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\handel\MicHandel;
use common\handel\SignHandel;
use common\handel\XmlHandle;
use yii\web\Response;

class ApiMiniLoginController extends ApiBaseController
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isGet) {
            return ['msg' => '状态异常,无法下单!', 'status' => false];
        }

        //开发者使用登陆凭证 code 获取 session_key 和 openid
        $WxCode = Yii::$app->request->get( 'code', null );

        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . self::$connData['appid'] . "&secret=" . self::$connData['app_secret'] . "&js_code=" . $WxCode . "&grant_type=authorization_code";

        $responseJson = XmlHandle::postCurl( $url );

        $data = json_decode( $responseJson );

        return ['data' => $data, 'status' => true];
    }
}