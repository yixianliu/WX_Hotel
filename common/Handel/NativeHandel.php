<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/5
 * Time: 22:40
 */

namespace common\handel;

use Yii;
use yii\base\Model;

class NativeHandel extends Model
{

    public static function ConnData($result, $connArray, $mch_api_psd = null)
    {

        if (empty($connArray)) {
            return ['status' => false, 'msg' => '商户平台数据不正确!'];
        }

        if (empty($result['total_fee'])) {
            return ['status' => false, 'msg' => '总金额为空!'];
        }

        if (empty($result['body'])) {
            return ['status' => false, 'msg' => '商品描述为空!'];
        }

        if (empty($result['attach']) || empty($result['goods_tag'])) {
            return ['status' => false, 'msg' => '附加数据为空或者标记为空!'];
        }

        if (empty($mch_api_psd)) {
            return ['status' => false, 'msg' => '平台操作密码为空!'];
        }

        $data = [
            'out_trade_no'     => SignHandel::getRandomString(),
            'total_fee'        => $result['total_fee'],
            'spbill_create_ip' => Yii::$app->request->getUserIP(),
            'body'             => $result['body'],
            'attach'           => $result['attach'],
            'goods_tag'        => $result['goods_tag'],
            'trade_type'       => 'NATIVE', // 原生扫码支付
        ];

        $dataArray = array_merge( $connArray, $data );

        // 签名
        if (!($dataArray['sign'] = SignHandel::SetSign( $dataArray, $mch_api_psd ))) {
            return ['status' => false, 'msg' => 'Sign 数据异常!'];
        }

        return $dataArray;
    }
}