<?php
/**
 *
 * 微信公众号 - 退款操作
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/11/7
 * Time: 11:10
 */

namespace common\handel;

use Yii;
use yii\base\Model;

class WxRefundHandel extends Model
{

    public static function Refund($result, $connArray)
    {

        if (empty( $result ) || empty( $connArray )) {
            return false;
        }

        $data = [
            'appid'          => $connArray['appid'],
            'mch_id'         => $connArray['mch_id'],
            'nonce_str'      => $connArray['nonce_str'],
            'out_refund_no'  => $result['out_refund_no'],
            'out_trade_no'   => $result['out_trade_no'],
            'refund_fee'     => $result['refund_fee'],
            'total_fee'      => $result['total_fee'],
            'transaction_id' => $result['transaction_id'],
        ];

        // 签名
        if (!($data['sign'] = SignHandel::SetSign( $data, $connArray['mch_api_psd'] ))) {
            return false;
        }

        $xml = XmlHandle::ArrayToXml( $data );

        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, true, 30 );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( $url, $startTimeStamp, $response );
        }

        $responseArray = XmlHandle::XmlToArray( $response );

        if (empty( $responseArray )) {
            return false;
        }

        return $responseArray;
    }

    /**
     * 查询退款
     *
     * @param $result
     * @param $connArray
     *
     * @return array|bool
     */
    public static function Query($result, $connArray)
    {

        if (empty( $result ) || empty( $connArray )) {
            return false;
        }

        $data = [
            'appid'          => $connArray['appid'],
            'mch_id'         => $connArray['mch_id'],
            'nonce_str'      => $connArray['nonce_str'],
            'out_refund_no'  => $result['out_refund_no'],
            'out_trade_no'   => $result['out_trade_no'],
            'refund_id'      => null,
            'transaction_id' => null,
        ];

        // 签名
        if (!($data['sign'] = SignHandel::SetSign( $data, $connArray['mch_api_psd'] ))) {
            return ['status' => false, 'msg' => '签名有误!'];
        }

        $xml = XmlHandle::ArrayToXml( $data );

        $url = 'https://api.mch.weixin.qq.com/pay/refundquery';

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, false, 30 );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( $url, $startTimeStamp, $response );
        }

        $responseArray = XmlHandle::XmlToArray( $response );

        return $responseArray;
    }
}