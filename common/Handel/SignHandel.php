<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/9
 * Time: 17:10
 */

namespace common\handel;

use Yii;

class SignHandel extends \yii\base\Model
{

    public static $signArray = [];

    /**
     * 检测签名
     *
     * @param $data
     *
     * @return bool
     */
    public static function CheckSign($data)
    {

        // 签名错误
        // fix异常
        if (!static::IsSignSet( $data )) {
            return false;
        }

        $sign = static::MakeSign( $data );

        if (static::GetSign( $data['sign'] ) == $sign) {
            return true;
        }

        return false;
    }

    /**
     * 判断签名，详见签名生成算法是否存在
     *
     * @param $data
     *
     * @return bool
     */
    public static function IsSignSet($data)
    {

        // 查看数组是否存在相关的key
        return array_key_exists( 'sign', $data );
    }

    /**
     * 设置签名，详见签名生成算法
     *
     * @param $data
     * @param $key
     *
     * @return bool
     */
    public static function SetSign($data, $key)
    {

        if (empty( $data ))
            return false;

        if (!($sign = static::MakeSign( $data, $key )))
            return false;

        return $sign;
    }

    /**
     * 生成签名,签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     *
     * @param $data
     * @param $key
     *
     * @return bool|string
     */
    public static function MakeSign($data, $key = null)
    {

        if (empty( $data ))
            return false;

        // 签名步骤一：按字典序排序参数
        ksort( $data );

        $string = static::ToUrlParams( $data );

        // 签名步骤二：在string后加入KEY(商户平台 API 密码)
        if (!empty( $key )) {
            $string = $string . "&key=" . $key;
        }

        //签名步骤三：MD5加密
        $string = md5( $string );

        //签名步骤四：所有字符转为大写
        $result = strtoupper( $string );

        return $result;
    }

    /**
     * 格式化参数格式化成url参数
     *
     * @param $data
     *
     * @return string
     */
    public static function ToUrlParams($data)
    {

        $buff = "";

        foreach ($data as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array( $v )) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim( $buff, "&" );

        return $buff;
    }

    /**
     * 获取签名，详见签名生成算法的值
     *
     * @param $sign
     *
     * @return bool
     */
    public static function GetSign($sign)
    {

        if (empty( $sign ))
            return false;

        return $sign;
    }

    /**
     * 随机生成关键KEY
     *
     * @param      $len
     * @param null $chars
     *
     * @return string
     */
    public static function getRandomString($len = 4, $chars = null)
    {

        if (is_null( $chars )) {
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }

        mt_srand( 10000000 * (double)microtime() );

        for ($i = 0, $str = '', $lc = strlen( $chars ) - 1; $i < $len; $i++) {
            $str .= $chars[ mt_rand( 0, $lc ) ];
        }

        $str = $str . '_' . time() . '_' . rand( 0000, 9999 );

        return $str;
    }

}