<?php
/**
 *
 * H5 支付接口
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/25
 * Time: 17:10
 */

namespace api\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\handel\MicHandel;
use common\handel\SignHandel;
use common\handel\XmlHandle;

class ApiWxPayController extends Controller
{

    /**
     * 微信购买
     *
     * @return array|bool
     */
    public function actionIndex()
    {

        if (!Yii::$app->request->isAjax || !Yii::$app->session->isActive || Yii::$app->session['status'] != true) {
            return false;
        }

        $openid = Yii::$app->request->get( 'openid', null );

        // 单号
        $out_trade_no = Yii::$app->request->get( 'out_trade_no', null );

        // 价格
        $total_fee = Yii::$app->request->get( 'total_fee', null );

        if (($xml = static::WxConf( $openid, $out_trade_no, $total_fee ))) {
            return false;
        }

        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

        $timeOut = 30;

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, false, $timeOut );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( $url, $startTimeStamp, $response );
        }

        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        return XmlHandle::XmlToArray( $response );
    }

    /**
     * 获取相关资料(SESSION)
     *
     * @param $openid
     * @param $out_trade_no
     * @param $total_fee
     *
     * @return bool|string
     */
    public static function WxConf($openid, $out_trade_no, $total_fee)
    {

        $session = Yii::$app->session;

        $post['appid'] = $session['conn']['appid'];
        $post['body'] = $session['conn']['body'];
        $post['mch_id'] = $session['conn']['mch_id'];
        $post['nonce_str'] = MicHandel::getNonceStr();// 随机字符串
        $post['notify_url'] = Url::to( 'api-notify/index' );
        $post['openid'] = $openid;
        $post['out_trade_no'] = $out_trade_no;
        $post['spbill_create_ip'] = Yii::$app->request->getUserIP();// 终端 IP
        $post['total_fee'] = $total_fee; // 总金额 
        $post['trade_type'] = 'JSAPI';

        // 签名
        if (!($post['sign'] = SignHandel::SetSign( $post, $session['conn']['mch_api_psd'] ))) {
            return false;
        }

        $xml = XmlHandle::ArrayToXml( $post );

        return $xml;
    }
}