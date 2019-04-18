<?php
/**
 *
 * 搜集商户平台资料
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/8
 * Time: 15:30
 */

namespace common\handel;

use Yii;
use yii\base\Model;

class MicHandel extends Model
{

    //=======【上报信息配置】===================================
    /**
     * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
     * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
     * 开启错误上报。
     * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
     * @var int
     */
    const REPORT_LEVENL = 1;

    public static $connArray = [];

    /**
     * 商户平台连接
     *
     * @param $result
     *
     * @return bool
     */
    public static function MicConnData($result)
    {

        if (empty( $result ) || empty( $result['appid'] ) || empty( $result['mch_id'] )) {
            return ['status' => false, 'msg' => '内容不可以为空'];
        }

        $connArray = [
            'appid'       => $result['appid'], // 公众账号ID
            'mch_id'      => $result['mch_id'], // 商户号
            'nonce_str'   => static::getNonceStr(), // 随机字符串
            'notify_url'  => 'http://wxpay.wxutil.com/pub_v2/pay/notify.v2.php',
            'mch_api_psd' => $result['mch_api_psd'],
        ];

        return $connArray;
    }

    /**
     * 产生随机字符串，不长于32位
     *
     * @param int $length
     *
     * @return 产生的随机字符串
     */
    public static function getNonceStr($length = 32)
    {

        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";

        $str = "";

        for ($i = 0; $i < $length; $i++) {
            $str .= substr( $chars, mt_rand( 0, strlen( $chars ) - 1 ), 1 );
        }

        return $str;
    }

    /**
     * 设置返回信息，如非空，为错误原因签名失败参数格式校验错误
     *
     * @param string $value
     **/
    public function SetReturn_msg($value)
    {
        static::$connArray['return_msg'] = $value;
    }

    /**
     * 获取返回信息，如非空，为错误原因签名失败参数格式校验错误的值
     * @return 值
     **/
    public function GetReturn_msg()
    {
        return static::$connArray['return_msg'];
    }

    /**
     * 判断返回信息，如非空，为错误原因签名失败参数格式校验错误是否存在
     * @return true 或 false
     **/
    public function IsReturn_msgSet()
    {
        return array_key_exists( 'return_msg', static::$connArray );
    }


    /**
     * 设置SUCCESS/FAIL
     *
     * @param string $value
     **/
    public function SetResult_code($value)
    {
        static::$connArray['result_code'] = $value;
    }

    /**
     * 获取SUCCESS/FAIL的值
     * @return 值
     **/
    public function GetResult_code()
    {
        return static::$connArray['result_code'];
    }

    /**
     * 判断SUCCESS/FAIL是否存在
     * @return true 或 false
     **/
    public function IsResult_codeSet()
    {
        return array_key_exists( 'result_code', static::$connArray );
    }

    /**
     * 设置SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看trade_state来判断
     *
     * @param string $value
     **/
    public function SetReturn_code($value)
    {
        static::$connArray['return_code'] = $value;
    }

    /**
     * 获取SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看trade_state来判断的值
     * @return 值
     **/
    public function GetReturn_code()
    {
        return static::$connArray['return_code'];
    }

    /**
     * 判断SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看trade_state来判断是否存在
     * @return true 或 false
     **/
    public function IsReturn_codeSet()
    {
        return array_key_exists( 'return_code', static::$connArray );
    }

    /**
     * 设置ORDERNOTEXIST—订单不存在SYSTEMERROR—系统错误
     *
     * @param string $value
     **/
    public function SetErr_code($value)
    {
        static::$connArray['err_code'] = $value;
    }

    /**
     * 获取ORDERNOTEXIST—订单不存在SYSTEMERROR—系统错误的值
     * @return 值
     **/
    public function GetErr_code()
    {
        return static::$connArray['err_code'];
    }

    /**
     * 判断ORDERNOTEXIST—订单不存在SYSTEMERROR—系统错误是否存在
     * @return true 或 false
     **/
    public function IsErr_codeSet()
    {
        return array_key_exists( 'err_code', static::$connArray );
    }

    /**
     * 设置结果信息描述
     *
     * @param string $value
     **/
    public function SetErr_code_des($value)
    {
        static::$connArray['err_code_des'] = $value;
    }

    /**
     * 获取结果信息描述的值
     * @return 值
     **/
    public function GetErr_code_des()
    {
        return static::$connArray['err_code_des'];
    }

    /**
     * 判断结果信息描述是否存在
     * @return true 或 false
     **/
    public function IsErr_code_desSet()
    {
        return array_key_exists( 'err_code_des', static::$connArray );
    }

    /**
     * 支付结果通用通知
     *
     * @param function $callback
     * 直接回调函数使用方法: notify(you_function);
     * 回调类成员函数方法:notify(array($this, you_function));
     * $callback  原型为：function function_name($data){}
     */
    public static function notify($callback, &$msg)
    {

        //获取通知的数据
        $xml = file_get_contents( 'php://input' );

        // 如果返回成功则验证签名
        try {

            $result = XmlHandle::InitXml( $xml );

        } catch (WxPayException $e) {

            $msg = $e->errorMessage();

            return false;
        }

        return call_user_func( $callback, $result );
    }

    /**
     * 获取毫秒级别的时间戳
     */
    public static function getMillisecond()
    {
        //获取毫秒的时间戳
        $time = explode( " ", microtime() );
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode( ".", $time );
        $time = $time2[0];

        return $time;
    }

    /**
     * 上报数据， 上报的时候将屏蔽所有异常流程
     *
     * @param $url
     * @param $startTimeStamp
     * @param $data
     *
     * @return array|void
     */
    public static function reportCostTime($url, $startTimeStamp, $data)
    {
        // 如果不需要上报数据
        if (static::REPORT_LEVENL == 0) {
            return;
        }

        // 如果仅失败上报
        if (static::REPORT_LEVENL == 1 && array_key_exists( "return_code", $data ) && $data["return_code"] == "SUCCESS" && array_key_exists( "result_code", $data ) && $data["result_code"] == "SUCCESS") {
            return;
        }

        //上报逻辑
        $endTimeStamp = static::getMillisecond();

        $data['interface_url'] = $url;
        $data['execute_time_'] = $endTimeStamp - $startTimeStamp;

        $xml = XmlHandle::ArrayToXml( $data );

        $timeOut = 1;

        $response = XmlHandle::postXmlCurl( $xml, $url, false, $timeOut );

        return $response;
    }

}
