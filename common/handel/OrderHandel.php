<?php
/**
 *
 * 订单各种功能操作
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/4
 * Time: 11:04
 */

namespace common\handel;

use Yii;
use yii\log\EmailTarget;

class OrderHandel extends \yii\base\Model
{

    /**
     * 查询订单，WxPayOrderQuery中out_trade_no、transaction_id至少填一个 appid、mchid、spbill_create_ip、nonce_str不需要填入
     *
     * @param     $result
     * @param     $url
     * @param int $timeOut
     *
     * @return bool
     */
    public static function WxPayQueryOrder($result, $url, $timeOut = 6)
    {

        // 检测必填参数
        if (empty( $result['out_trade_no'] ) && empty( $result['transaction_id'] )) {
            return false;
        }

        // 需要的参数
        $orderCurl['appid'] = $result['appid'];
        $orderCurl['mch_id'] = $result['mch_id'];
        $orderCurl['nonce_str'] = $result['nonce_str'];

        if (!empty( $result['transaction_id'] )) {
            $orderCurl['transaction_id'] = $result['transaction_id'];
        }

        if (!empty( $result['out_trade_no'] ) && empty( $result['transaction_id'] )) {
            $orderCurl['out_trade_no'] = $result['out_trade_no'];
        }

        // 签名
        if (!($orderCurl['sign'] = SignHandel::SetSign( $orderCurl, $result['key'] )))
            return false;

        $xml = XmlHandle::ArrayToXml( $orderCurl );

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, false, $timeOut );

        $responseArray = static::XmlToArray( $response );

        // 上报请求花费时间
        if ($responseArray['return_code'] == 'SUCCESS')
            MicHandel::reportCostTime( $url, $startTimeStamp, $responseArray );

        return $responseArray;
    }

    /**
     * 下载对账单，WxPayDownloadBill中bill_date为必填参数 appid、mchid | spbill_create_ip、nonce_str不需要填入
     *
     * @param      $result
     * @param      $url
     * @param null $key 商户平台支付密码
     *
     * @return array|bool|string
     */
    public static function WxDownloadBill($result, $url, $key = null)
    {

        // 签名
        $result['sign'] = SignHandel::SetSign( $result, $key );

        $xml = XmlHandle::ArrayToXml( $result, $key );

        if (empty( $xml )) {
            return false;
        }

        $response = XmlHandle::postXmlCurl( $xml, $url, false );

        if (empty( $response ) || substr( $response, 0, 5 ) == "<xml>") {
            return "";
        }

        return $response;
    }
}