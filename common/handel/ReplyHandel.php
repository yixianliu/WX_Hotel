<?php
/**
 *
 * 回调基础类
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/27
 * Time: 17:24
 */

namespace common\handel;

use Yii;

class ReplyHandel extends \yii\base\Model
{

    public static $signArray = array();

    /**
     *
     * 设置错误码 FAIL 或者 SUCCESS
     * @param string
     */
    public function SetReturn_code($return_code)
    {
        static::$signArray['return_code'] = $return_code;
    }

    /**
     *
     * 获取错误码 FAIL 或者 SUCCESS
     * @return string $return_code
     */
    public function GetReturn_code()
    {
        return static::$signArray['return_code'];
    }

    /**
     *
     * 设置错误信息
     * @param string $return_code
     */
    public function SetReturn_msg($return_msg)
    {
        static::$signArray['return_msg'] = $return_msg;
    }

    /**
     *
     * 获取错误信息
     * @return string
     */
    public function GetReturn_msg()
    {
        return static::$signArray['return_msg'];
    }

}