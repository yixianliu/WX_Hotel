<?php
/**
 *
 * 接口基本内容
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/11
 * Time: 11:13
 */

namespace api\controllers;

use Yii;
use yii\web\Controller;
use common\models\MiniProgramConf;
use common\models\MpConf;

class ApiBaseController extends Controller
{

    static public $defaultMiniProgram = 'ZBTY_1555992015_8693';

    public static $defaultMp = 'BOHI_1555577880_1240';

    static public $MiniProgramConnData = [];

    static public $MpConnData = [];

    public function init()
    {

        static::GetMiniProgram();

        static::GetMp();

        return true;
    }

    /**
     * 获取小程序配置
     *
     * @param null $id
     *
     * @return array
     */
    public static function GetMiniProgram($id = null)
    {

        if (empty( $id ))
            $id = static::$defaultMiniProgram;

        static::$MiniProgramConnData = MiniProgramConf::findOne( ['conf_id' => $id] )->toArray();


        return true;
    }

    /**
     * 获取公众号配置
     *
     * @param null $id
     *
     * @return array
     */
    public static function GetMp($id = null)
    {

        if (empty( $id ))
            $id = static::$defaultMp;

        static::$MpConnData = MpConf::findOne( ['conf_id' => $id] )->toArray();
    }

    /**
     * 随机生成关键KEY
     *
     * @param      $len
     * @param null $chars
     *
     * @return string
     */
    public static function getRandomString($len = 8, $chars = null)
    {

        if (is_null( $chars )) {
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }

        mt_srand( 10000000 * (double)microtime() );

        for ($i = 0, $str = '', $lc = strlen( $chars ) - 1; $i < $len; $i++) {
            $str .= $chars[ mt_rand( 0, $lc ) ];
        }

        $str = $str . '_' . time() . '_' . rand( 10000, 99999 );

        return $str;
    }

}