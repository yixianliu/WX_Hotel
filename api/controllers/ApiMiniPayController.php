<?php
/**
 *
 * 小程序支付接口
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/11
 * Time: 11:29
 */

namespace api\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\handel\MicHandel;
use common\handel\SignHandel;
use common\handel\XmlHandle;
use yii\web\Response;

class ApiMiniPayController extends ApiBaseController
{

    public $enableCsrfValidation = false;

    public static $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    public function actionPay()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isPost) {
            return ['msg' => '状态异常,无法下单!', 'status' => false];
        }

        $openid = Yii::$app->request->get( 'openid', null );

        $contents = file_get_contents('php://input');

        $data = json_decode($contents,true);

        if (empty($data['total_fee']) || empty($data['body'])) {
            return ['msg' => '金额和产品内容为空,请查看!', 'status' => false];
        }

        $post['appid'] = self::$MiniProgramConnData['appid'];
        $post['body'] = $data['body'];
        $post['mch_id'] = self::$MiniProgramConnData['mch_id'];
        $post['nonce_str'] = MicHandel::getNonceStr(); // 随机字符串
        $post['notify_url'] = Url::to( 'api-notify/index' );
        $post['openid'] = $openid;
        $post['out_trade_no'] = self::getRandomString();
        $post['spbill_create_ip'] = Yii::$app->request->getUserIP();// 终端 IP
        $post['total_fee'] = $data['total_fee']; // 总金额 
        $post['trade_type'] = 'JSAPI';

        // 签名
        if (!($post['sign'] = SignHandel::SetSign( $post, self::$apiMchPsd ))) {
            return ['msg' => '签名失败!', 'status' => false];
        }

        $xml = XmlHandle::ArrayToXml( $post );

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, static::$url, false, 30 );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( static::$url, $startTimeStamp, $response );
        }

        return XmlHandle::XmlToArray( $response );
    }

}