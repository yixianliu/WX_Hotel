<?php
/**
 *
 * 操作 XML 数据转换
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/9
 * Time: 17:01
 */

namespace common\handel;

use Yii;
use yii\base\Model;

class XmlHandle extends Model
{

    // curl代理设置
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    const CURL_PROXY_HOST = "0.0.0.0";// "10.152.18.220";
    const CURL_PROXY_PORT = 0;// 8080;

    /**
     * 将 xml 转为 array
     *
     * @param $xml
     *
     * @return array
     */
    public static function XmlToArray($xml)
    {

        if (empty( $xml )) {
            return false;
        }

        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader( true );

        $xmlToArray = json_decode( json_encode( simplexml_load_string( $xml, 'SimpleXMLElement', LIBXML_NOCDATA ) ), true );

        //fix bug 2015-06-29
        if (empty( $xmlToArray['return_code'] ) || $xmlToArray['return_code'] != 'SUCCESS') {
            return $xmlToArray;
        }

//        SignHandel::CheckSign();

        return $xmlToArray;
    }

    /**
     * 输出xml字符
     *
     * @param $array
     *
     * @return bool|string
     */
    public static function ArrayToXml($array)
    {

        // 检查数组
        if (!is_array( $array ) || count( $array ) <= 0) {
            return false;
        }

        $xml = "<xml>";
        foreach ($array as $key => $val) {
            $xml .= is_numeric( $val ) ? "<" . $key . ">" . $val . "</" . $key . ">" : "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";

        return $xml;
    }


    /**
     * 使用数组初始化
     *
     * @param array $array
     */
    public static function FromArray($array)
    {
        static::$xmlArray = $array;
    }

    /**
     * 使用数组初始化对象
     *
     * @param array  $array
     * @param 是否检测签名 $noCheckSign
     */
    public static function InitFromArray($array, $noCheckSign = false)
    {

        static::FromArray( $array );

        if ($noCheckSign == false) {
            return SignHandel::CheckSign( static::$xmlArray );
        }

        return true;
    }

    /**
     * 以post方式提交xml到对应的接口url
     *
     * @param string $xml     需要post的xml数据
     * @param string $url     url
     * @param bool   $useCert 是否需要证书，默认不需要
     * @param int    $second  url执行超时时间，默认30s
     *
     * @return array
     */
    public static function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {

        if (empty( $xml ) || empty( $url )) {
            return false;
        }

        $ch = curl_init();

        // 设置超时
        curl_setopt( $ch, CURLOPT_TIMEOUT, $second );

        // 如果有配置代理这里就设置代理
        if (self::CURL_PROXY_HOST != "0.0.0.0" && self::CURL_PROXY_PORT != 0) {
            curl_setopt( $ch, CURLOPT_PROXY, static::CURL_PROXY_HOST );
            curl_setopt( $ch, CURLOPT_PROXYPORT, static::CURL_PROXY_PORT );
        }

        curl_setopt( $ch, CURLOPT_URL, $url );

        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

        // 设置 header
        curl_setopt( $ch, CURLOPT_HEADER, false );

        // 要求结果为字符串且输出到屏幕上
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        // 设置证书
        if ($useCert == true) {

            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt( $ch, CURLOPT_SSLCERTTYPE, 'PEM' );
            curl_setopt( $ch, CURLOPT_SSLCERT, Yii::getAlias( '@webroot' ) . '/temp/ssl/apiclient_cert.pem' );
            curl_setopt( $ch, CURLOPT_SSLKEYTYPE, 'PEM' );
            curl_setopt( $ch, CURLOPT_SSLKEY, Yii::getAlias( '@webroot' ) . '/temp/ssl/apiclient_key.pem' );
        }

        // post提交方式
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );

        // 运行curl
        $data = curl_exec( $ch );

        // 返回结果
        if ($data) {

            curl_close( $ch );
//            return static::XmlToArray($data);
            return $data;
        }

        $error = curl_errno( $ch );
        curl_close( $ch );

        return ['msg' => 'curl出错，错误码 : ' . $error, 'status' => false];
    }

    /**
     * CURL 提交
     *
     * @param      $url
     * @param null $data
     *
     * @return bool|string
     */
    public static function postCurl($url, $data = null)
    {

        $httpHeader = [
            'Host'            => 't.xx.com',
            'Connection'      => 'keep-alive',
            'Cookie'          => '_hc.v=d846d370-b934-97da-2584-df1d51be8040.1476003831; aburl=1; cy=2; cye=beijing; _tr.u=rw0PincYp5DQrbEl; t_rct=20921750; PHOENIX_ID=0a010818-158198588e7-de0339',
            'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate, sdch',
        ];

        $curl = curl_init();

        curl_setopt( $curl, CURLOPT_HTTPHEADER, $httpHeader );
        curl_setopt( $curl, CURLOPT_URL, $url );

        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );

        if (!empty( $data )) {
            curl_setopt( $curl, CURLOPT_POST, 1 );
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
        }

        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec( $curl );
        curl_close( $curl );

        return $output;
    }
}