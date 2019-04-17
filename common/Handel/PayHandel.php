<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/12
 * Time: 11:07
 */

namespace common\handel;

use Yii;
use yii\base\Model;

class PayHandel extends Model
{

    // curl代理设置
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    const CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
    const CURL_PROXY_PORT = 0;//8080;

    /**
     * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填 | appid、mchid、spbill_create_ip、nonce_str不需要填入
     *
     * @param     $mch  商户基本资料
     * @param     $data 订单资料
     * @param     $url
     * @param int $timeOut
     *
     * @return array
     */
    public static function WxPayUnifiedOrder($mch, $data, $url, $timeOut = 6)
    {

        if (empty( $data ) || empty( $mch ) || empty( $url )) {
            return ['status' => false, 'msg' => '内容不可以为空'];
        }

        $array = [
            'openid'           => $data['openid'],
            'body'             => $data['body'],
            'detail'           => $data['detail'],
            'product_id'       => $data['product_id'],
            'total_fee'        => $data['total_fee'],
            'out_trade_no'     => $data['out_trade_no'], // 商户订单号
            'fee_type'         => 'CNY', // 货币类型
            'trade_type'       => 'MWEB', // 交易类型
            'attach'           => $data['attach'],
            'scene_info'       => '{"h5_info": {"type":"Wap","wap_url": "https://pay.qq.com","wap_name": "腾讯充值"}}',
            'spbill_create_ip' => Yii::$app->request->userIP,
        ];

        $array = array_merge( $mch, $array );

        // 签名
        if (!($array['sign'] = SignHandel::SetSign( $array, $mch['mch_api_psd'] ))) {
            return ['status' => false, 'msg' => '签名有误!'];
        }

        $xml = XmlHandle::ArrayToXml( $array );

        // 请求开始时间
        $startTimeStamp = MicHandel::getMillisecond();

        $response = XmlHandle::postXmlCurl( $xml, $url, false, $timeOut );

        // 上报请求花费时间
        if ($response['return_code'] == 'SUCCESS') {
            MicHandel::reportCostTime( $url, $startTimeStamp, $response );
        }

        $responseArray = XmlHandle::XmlToArray( $response );

        return $responseArray;
    }

    /**
     * 通过跳转获取用户的openid，跳转流程如下：
     *
     * 1、设置自己需要调回的url及其其他参数，跳转到微信服务器https://open.weixin.qq.com/connect/oauth2/authorize
     * 2、微信服务处理完成之后会跳转回用户redirect_uri地址，此时会带上一些参数，如：code
     *
     * @param $appid
     *
     * @return openid
     */
    public static function GetOpenid($appid)
    {

        if (empty( $appid )) {
            return false;
        }

        // 通过code获得openid
        if (!isset( $_GET['code'] )) {

            // 触发微信返回code码
            $baseUrl = urlencode( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'] );
            $url = static::__CreateOauthUrlForCode( $baseUrl, $appid );
            Header( "Location: $url" );
            exit();

        } else {

            // 获取code码，以获取openid
            $code = $_GET['code'];
            $openid = static::GetOpenidFromMp( $code );

            return $openid;
        }
    }

    /**
     * 获取jsapi支付的参数
     *
     * @param array $UnifiedOrderResult 统一支付接口返回的数据
     *
     * @return json数据，可直接填入js函数作为参数
     * @throws WxPayException
     *
     */
    public static function GetJsApiParameters($UnifiedOrderResult)
    {
        if (!array_key_exists( "appid", $UnifiedOrderResult ) || !array_key_exists( "prepay_id", $UnifiedOrderResult ) || $UnifiedOrderResult['prepay_id'] == "") {
//            throw new WxPayException( "参数错误" );
            return false;
        }

        $array = [
            'appid'     => $UnifiedOrderResult["appid"],
            'timeStamp' => time(),
            'nonceStr'  => MicHandel::getNonceStr(),
            'package'   => "prepay_id=" . $UnifiedOrderResult['prepay_id'],
            'signType'  => 'MD5',
        ];

        // 签名
        if (!($array['paySign'] = SignHandel::MakeSign( $array ))) {
            return false;
        }

        return json_encode( $array );
    }

    /**
     *
     * 通过code从工作平台获取openid机器access_token
     *
     * @param string $code 微信跳转回来带上的code
     *
     * @return openid
     */
    public static function GetOpenidFromMp($code, $curl_timeout = 30)
    {

        if (empty( $code )) {
            return false;
        }

        $url = static::__CreateOauthUrlForOpenid( $code );

        // 初始化curl
        $ch = curl_init();

        // 设置超时
        curl_setopt( $ch, CURLOPT_TIMEOUT, $curl_timeout );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        if (static::CURL_PROXY_HOST != "0.0.0.0" && static::CURL_PROXY_PORT != 0) {
            curl_setopt( $ch, CURLOPT_PROXY, static::CURL_PROXY_HOST );
            curl_setopt( $ch, CURLOPT_PROXYPORT, static::CURL_PROXY_PORT );
        }

        //运行curl，结果以jason形式返回
        $res = curl_exec( $ch );
        curl_close( $ch );

        //取出openid
        $data = json_decode( $res, true );

        static::$data = $data;

        $openid = $data['openid'];

        return $openid;
    }

    /**
     * 获取地址js参数,获取共享收货地址js函数需要的参数，json格式可以直接做参数使用
     *
     * @param $appid
     * @param $access_token
     *
     * @return string
     */
    public function GetEditAddressParameters($appid, $access_token)
    {
        $data = [];

        $data["appid"] = $appid;
        $data["url"] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $data["timestamp"] = time();
        $data["noncestr"] = MicHandel::getNonceStr();
        $data["accesstoken"] = $access_token;

        ksort( $data );

        $params = SignHandel::ToUrlParams( $data );

        $afterData = [
            "addrSign"  => sha1( $params ),
            "signType"  => "sha1",
            "scope"     => "jsapi_address",
            "appId"     => $appid,
            "timeStamp" => $data["timestamp"],
            "nonceStr"  => $data["noncestr"],
        ];

        return json_encode( $afterData );
    }

    /**
     *
     * 构造获取code的url连接
     *
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     *
     * @return 返回构造好的url
     */
    public static function __CreateOauthUrlForCode($redirectUrl, $appid)
    {

        if (empty( $redirectUrl ) || empty( $appid )) {
            return false;
        }

        $urlObj["appid"] = $appid;
        $urlObj["redirect_uri"] = $redirectUrl;
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE" . "#wechat_redirect";

        $bizString = SignHandel::ToUrlParams( $urlObj );

        return "https://open.weixin.qq.com/connect/oauth2/authorize?" . $bizString;
    }

    /**
     * 构造获取open和access_toke的url地址
     *
     * @param $code 微信跳转带回的code
     * @param $appid
     * @param $appsecret
     *
     * @return bool|string
     */
    public static function __CreateOauthUrlForOpenid($code, $appid, $appsecret)
    {
        if (empty( $code ) || empty( $appid ) || empty( $appsecret )) {
            return false;
        }

        $array = [
            'appid'      => $appid,
            'secret'     => $appsecret,
            'code'       => $code,
            'grant_type' => 'authorization_code',
        ];

        $bizString = SignHandel::ToUrlParams( $array );

        return "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
    }

}