<?php
/**
 *
 * H5 申请退款
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/2
 * Time: 15:59
 */

namespace api\controllers;

use Yii;
use yii\web\Controller;
use common\handel\MicHandel;
use common\handel\SignHandel;
use common\handel\XmlHandle;

class ApiWxRefundController extends ApiBaseController
{

    public function actionIndex()
    {

        $session = Yii::$app->session;

        // 检查session是否开启
        if (!$session->isActive || $session['conn']['status'] == true || !Yii::$app->request->isAjax) {
            return false;
        }

        $out_refund_no = ApiBaseController::getRandomString();

        $total_fee = Yii::$app->request->get( 'total_fee', null );

        $refund_fee = Yii::$app->request->get( 'refund_fee', null );

        $post = [
            'appid'         => $session['conn']['appid'],
            'mch_id'        => $session['conn']['mch_id'],
            'nonce_str'     => MicHandel::getNonceStr(),
            'out_refund_no' => $out_refund_no,
            'out_trade_no'  => BaseController::getRandomString(),
            'total_fee'     => $total_fee,
            'refund_fee'    => $refund_fee,
            'op_user_id'    => $session['conn']['open_id'],
        ];

        // 签名
        if (!($post['sign'] = SignHandel::SetSign( $post, $session['conn']['mch_api_psd'] ))) {
            return false;
        }

        $xml = XmlHandle::ArrayToXml( $post );

        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

        $timeOut = 30;

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, true, $timeOut );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( $url, $startTimeStamp, $response );
        }

        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        return XmlHandle::XmlToArray( $response );
    }

}